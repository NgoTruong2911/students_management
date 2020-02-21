<?php

namespace App\Repositories\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\EloquentRepository;

class RoleEloquentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Role::class;
    }

    // public function getRole()
    // {
    //     return Role::pluck('name', 'id')->all();
    // }

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
