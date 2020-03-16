<?php

namespace App\Repositories\User;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class UserEloquentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getModelWith($relation)
    {
        return \App\Models\User::with($relation);
    }

    public function authUser()
    {
        return Auth::user();
    }

    public function saveImage($name = 'avatar')
    {
        //dd(request()->file($name)->extension());
        $image = request()->file($name);
        $imageName = time() . '.' . $image->extension();
        $image->move('images', $imageName);
        return sprintf('images/%s', $imageName);
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search($data = [])
    {

        $users = $this->_model->newQuery();
        // $users->join('user_subject', 'users.id', '=', 'user_subject.user_id');

        if (!empty($data['point_min']) || !empty($data['point_max'])) {
            $users->whereHas('subjects', function ($query) use ($data) {
                if (!empty($data['point_min'])) {
                    $query->where('point', '>=', $data['point_min']);
                }
                if (!empty($data['point_max'])) {
                    $query->where('point', '<=', $data['point_max']);
                }
            });
        }
        //filter point
        if (!empty($data['age_min']) || !empty($data['age_max'])) {
            if (!empty($data['age_min'])) {
                $min_year = Carbon::now()->subYear($data['age_min'])->startOfYear()->format('Y-m-d');
                $users->whereDate('birthday', '<=', $min_year);
            }
            if ($data['age_max'] >= 0) {
                $max_year = Carbon::now()->subYear($data['age_max'])->startOfYear()->format('Y-m-d');
                $users->whereDate('birthday', '>=',  $max_year);
            }
        }
        // filter age
        if (!empty($data['phone_number'])) {
            $users->where(function ($query) use($data) {
                foreach ($data['phone_number'] as $phone) {
                    $query->orWhere('phone_number', 'regexp', $phone);
                }
            });
        }
        // }
        if (!empty($data['filter_point'])) {
            $subjects = Subject::all()->count(); //tổng số bản ghi của subjects
            if ($data['filter_point'] == 1) {
                $users->whereHas('subjects', function ($query) use ($data, $subjects) {

                    $query->where('point', '>=', 0);
                }, $subjects);
            }
            if ($data['filter_point'] == 2) {
                $users->whereHas('subjects', function ($query) use ($data, $subjects) {

                    $query->where('point', '>=', 0);
                }, '<', $subjects);
            }
        }
        return $users;
    }

    public function avgPoint($relation = [])
    {
        return $users = $this->_model->with($relation)->whereHas('userSubject', function ($query) {
            $query->selectRaw('user_id,AVG(user_subject.point) AS average_point')
                ->groupBy('user_id')
                ->havingRaw('average_point < ?', [5]);
        })->get();
    }

    public function getSlug($slug)
    {
        $user = $this->_model->newQuery();
        return $user->where('slug', $slug)->first();
    }
}
