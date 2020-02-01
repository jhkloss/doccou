<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $table = 'container';
    protected $primaryKey = 'id';

    public function user()
    {
        $this->belongsTo('App\User', 'id', 'user_id');
    }
}
