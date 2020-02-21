<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-delete']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-update']);

        //users
        Permission::create(['name' => 'users-delete']);
        Permission::create(['name' => 'users-list']);
        Permission::create(['name' => 'users-create']);
        Permission::create(['name' => 'users-update']);
        Permission::create(['name' => 'users-show']);

        //faculties
        Permission::create(['name' => 'faculties-delete']);
        Permission::create(['name' => 'faculties-list']);
        Permission::create(['name' => 'faculties-create']);
        Permission::create(['name' => 'faculties-update']);
        Permission::create(['name' => 'faculties-show']);

        //points
        Permission::create(['name' => 'points-delete']);
        Permission::create(['name' => 'points-create']);
        Permission::create(['name' => 'points-list']);
        Permission::create(['name' => 'points-update']);
        Permission::create(['name' => 'points-show']);

        //subjects
        Permission::create(['name' => 'subjects-delete']);
        Permission::create(['name' => 'subjects-create']);
        Permission::create(['name' => 'subjects-update']);
        Permission::create(['name' => 'subjects-list']);
        Permission::create(['name' => 'subjects-show']);

        //create role by permission

        $role = Role::create(['name' => 'user'])
            ->givePermissionTo([
            'subjects-create','subjects-update','subjects-show','subjects-list',
            'points-create','points-update','points-show','points-list',
            'faculties-create','faculties-update','faculties-show','faculties-list',
            'users-list','users-show',
            ]);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

    }
}
