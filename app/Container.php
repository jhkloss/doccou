<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $table = 'container';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User',  'user_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }

}
