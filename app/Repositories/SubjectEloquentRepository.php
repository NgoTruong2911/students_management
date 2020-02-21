<?php

namespace App\Repositories\Subject;

use App\Models\Subject;
use App\Repositories\EloquentRepository;

class SubjectEloquentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    public function saveImage($name)
    {

    }

    public function getAll()
    {
        return \App\Models\Subject::all();
    }

    public function search($number)
    {
        $subjects = $this->_model;
        return $subjects->paginate($number);
    }

    public function getModelWith($relation)
    {

    }
    
}
