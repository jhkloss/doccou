<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'id';

    public function tasks()
    {
        return $this->hasMany('App\Task', 'course_id', 'id');
    }

    public function members()
    {
        return $this->belongsToMany('App\User', 'course_user', 'user_id', 'course_id');
    }
}
