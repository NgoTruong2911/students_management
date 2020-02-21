<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description'];

    public function user_subject()
    {
        return $this->hasMany(User_subject::class, 'subject_id');
    }
}
