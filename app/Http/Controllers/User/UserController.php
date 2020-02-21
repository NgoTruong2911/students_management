<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\PointRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\RoleAndPermisson\RoleAndPermissonEloquentRepository;
use App\Repositories\RepositoryInterface;
use App\Repositories\Subject\SubjectEloquentRepository;
use Illuminate\Http\Request;
use App\Jobs\SendMailForExpulsion;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Faculty\FacultyEloquentRepository;
use App\Repositories\Role\RoleEloquentRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\Repository
     */
    protected $userEloquentRepository;
    protected $subjectEloquentRepository;
    protected $facultyEloquentRepository;
    protected $roleEloquentRepository;

    public function __construct(RepositoryInterface $userEloquentRepository, SubjectEloquentRepository $subjectEloquentRepository, FacultyEloquentRepository  $facultyEloquentRepository, RoleEloquentRepository $roleEloquentRepository)
    {
        $this->userEloquentRepository = $userEloquentRepository;
        $this->subjectEloquentRepository = $subjectEloquentRepository;
        $this->facultyEloquentRepository = $facultyEloquentRepository;
        $this->roleEloquentRepository = $roleEloquentRepository;
    }
    /**
     * List of user and search user
     * Param is the number of items for the current page in function search
     * Old input with flash
     * @var users get all users match requests
     */
    public function index()
    {
        request()->flash();
        $users = $this->userEloquentRepository->search(request()->all(), 5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @var subjects are list of subjects
     * @var role_all are list of name role
     * @var faculties are list of faculties
     * Return users.edit
     */
    public function create()
    {
        $subjects = $this->subjectEloquentRepository->getAll();
        $user = new User();
        $roles_all = $this->roleEloquentRepository->getAll();
        $roles = $roles_all->pluck('name', 'id')->all();
        $faculties =  $this->facultyEloquentRepository->getAll();;
        return view('users.edit', compact('user', 'faculties', 'subjects', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return users/index with status flash
     */
    public function store(UpdateUserRequest $request)
    {
        $req = $request->all();
        $req['age'] = Carbon::parse($request->birthday)->age;
        $req['avatar'] = $this->userEloquentRepository->saveImage();
        $req['password'] = bcrypt($req['password']);
        $user = $this->userEloquentRepository->create($req);
        $user->assignRole($req['roles']);
        return redirect()->route('users.index')->with('status', 'Create Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return users/$id/show
     */
    public function show($id)
    {

        $user = $this->userEloquentRepository->find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return users/$id/edit
     * @var user is user login
     * @var user_subjects is subjects learned by user
     * @var subjects_all is list of subject
     * @var subjects is list of subject student has not learned
     *
     */
    public function edit($id)
    {
        // request()->

        $user = $this->userEloquentRepository->authUser();
        $roles = $userRole = null;
        $user_id = strval($user->id);
        if ((!($user->hasPermissionTo('users-update'))) || ($user->hasRole('admin') && $user_id == $id)) {
            if ($user->id != $id) {
                abort(403);
            }
            $user = $this->userEloquentRepository->find($user_id, ['subjects']);
        } elseif ($user->hasRole('admin')) {
            $user = $this->userEloquentRepository->find($id, ['subjects']);
            $roles_all = $this->roleEloquentRepository->getAll();
            $roles = $roles_all->pluck('name', 'id')->all();
            $userRole = $user->roles->all();
        }
        $user_subjects = $user->subjects;
        $faculties =  $this->facultyEloquentRepository->getAll();
        $subjects_all = $this->subjectEloquentRepository->getAll();
        //subject all
        $subjects = $subjects_all->diff($user_subjects);
        if (request()->ajax()) {
            return response()->json(['user' => $user, 'faculties' => $faculties, 'roles' => $roles, 'userRole' => $userRole]);
        } else {
            return view('users.edit', compact('user', 'faculties', 'subjects', 'user_subjects', 'roles', 'userRole'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id is property id of user
     * @var authUser is user login in website
     * @return /users/ or status 403
     *
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $authUser = $this->userEloquentRepository->authUser();
        $user =  $this->userEloquentRepository->find($id);
        $req = $request->all();
        if ($request->hasFile('avatar')) {
            $req['avatar'] = $this->userEloquentRepository->saveImage();
        }
        if ($authUser->hasRole('admin') && $authUser->id != $id) {
            if ($request->password) {
                $req['password'] = bcrypt($req['password']);
            }
            else{
                unset($req['password']);
            }
            if ($request->input('roles')) {
                $role = $request->input('roles');
            }
            $save = $this->userEloquentRepository->update($id, $req)->syncRoles($role);
            if (request()->ajax()) {

                return $save;
            }
                return redirect()->route('users.index')->with('status', 'Update Successfull');

        } elseif ($authUser->id == $id) {
            if($request->password){
                $req['password'] = bcrypt($req['password']);
            }
            else{
                unset($req['password']);
            }
            $save = $this->userEloquentRepository->update($id, $req);
            if (request()->ajax()) {
                return $save;
            } else {
                return redirect()->route('users.index')->with('status', 'Update Successfull');
            }
        } else {
            abort(403);
        }
    }

    /** Update or create user with synchronized
     *
     * @param $request has type of [[subject_id]=>['column'=>'value']] apply for sync()
     * @param int $id is property id of user
     * @return users/$id/edit with messages flash successful
     *
     */

    public function createPoint(PointRequest $request, $id)
    {
        $auth_user = $this->userEloquentRepository->authUser();
        if ($auth_user->hasRole('admin')) {
            $users = $this->userEloquentRepository->find($id, ['subjects']);
            if ($request->subject_point) {
                $req = $request->subject_point;
                $users->subjects()->sync(
                    $req
                );
            } else {
                $users->subjects()->detach();
            }
        } elseif ($auth_user->hasRole('user') && $auth_user->id == $id) {
            $users = $this->userEloquentRepository->find($id, ['subjects']);
            if ($request->subject_point) {
                $req = $request->all();
                $users->subjects()->syncWithoutDetaching(
                    $req['subject_point'] = data_set($req['subject_point'], '*.point', 0)
                );
            }
        } else {
            abort(403);
        }
        return redirect()->route('users.edit', [$id])->with('status', 'Update Successfull')->withInput();
    }

    // update many point for user

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id is property id of user
     * @return users/index
     */
    public function destroy($id)
    {
        $this->userEloquentRepository->delete($id);
        return redirect()->route('users.index')->with('status', 'Delete Successfull');
    }

    /** Send email according to the conditional with queue mail laravel
     *
     * @var users is list of users have average of point less than 5
     * @var job is function contain view email, repeat time for send mailing
     * @return users/index with flash messages
     *
     */
    public function sendEmail()
    {
        $users = $this->userEloquentRepository->avgPoint(['userSubject' => function ($query) {
            $query->selectRaw('user_id,AVG(user_subject.point) AS average_point')
                ->groupBy('user_id')
                ->havingRaw('average_point < ?', [5]);
        }]);
        foreach ($users as $user) {
            $job = (new SendMailForExpulsion($user))->delay(Carbon::now()->addMinutes(10));
            dispatch($job);
        }
        return redirect()->route('users.index')->with('status', 'Gửi mail báo đuổi học thành công');
    }

    /** Profile of user login website
     *
     * @var user is information of user login in website with param email, address, age, password,..
     * @return profie after login
     *
     */
    public function profile()
    {
        $user = $this->userEloquentRepository->authUser();
        return view('profile.profile', compact('user'));
    }
}
