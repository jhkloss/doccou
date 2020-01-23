<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $touches = ['course'];

    public function course()
    {
        return $this->belongsTo('App\Course', 'id', 'course_id');
    }
}
