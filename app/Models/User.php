<?php

namespace App\Models;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class  User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name', 'birthday', 'phone_number', 'email', 'password', 'faculty_id', 'gender', 'avatar', 'age','id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'birthday' => 'date:Y-m-d',
    ];

    // protected $appends = ['pnb'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'user_subject')->withTimestamps('created_at', 'updated_at')->withPivot('point', 'user_id', 'subject_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function userSubject()
    {
        return $this->hasMany(User_subject::class, 'user_id');
    }

    public function rolesName()
    {
        return $this->belongsToMany(Role::class,'model_has_roles','model_id','role_id');
    }
}
