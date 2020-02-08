<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method where()
 */
class Task extends Model
{
    protected $table = 'task';

    protected $primaryKey = 'id';

    //protected $touches = ['course'];

    public function course()
    {
        return $this->belongsTo('App\Course','course_id', 'id');
    }
}
