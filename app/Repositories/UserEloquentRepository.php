<?php

namespace App\Repositories\User;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\EloquentRepository;

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
    public function search($data = [], $number = 10)
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
                $users->where('age', '>=', $data['age_min']);
            }
            if (!empty($data['age_max'])) {
                $users->where('age', '<=', $data['age_max']);
            }

        }
        // filter age
        if (!empty($data['phone_number'])) {
            foreach ($data['phone_number'] as $phone) {
                $users->orWhere('phone_number', 'regexp', $phone);
            }

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

        return $users->paginate($number);
    }

    public function avgPoint($relation = [])
    {

        return $users = $this->_model->with($relation)->whereHas('userSubject', function ($query) {
            $query->selectRaw('user_id,AVG(user_subject.point) AS average_point')
                ->groupBy('user_id')
                ->havingRaw('average_point < ?', [5]);
        })->get();
    }
}
