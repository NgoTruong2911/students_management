<?php

namespace App\Repositories\UserSubject;

use App\Repositories\EloquentRepository;

class UserSubjectEloquentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User_subject::class;
    }

    public function saveImage($name)
    {

    }

    public function search($number)
    {

    }

    public function getModelWith($relation)
    {

    }

}
