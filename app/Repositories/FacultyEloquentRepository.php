<?php

namespace App\Repositories\Faculty;

use App\Repositories\EloquentRepository;

class FacultyEloquentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Faculty::class;
    }

    public function saveImage($name)
    {

    }

    public function getAll()
    {
        return \App\Models\Faculty::all();
    }

    public function search($number)
    {

    }

    public function getModelWith($relation)
    {

    }

}
