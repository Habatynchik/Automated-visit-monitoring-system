<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'id_assistant');
    }

    public function schedule()
    {
    	return $this->hasMany('App\Schedule', 'id_classroom', 'id');
    }
}
