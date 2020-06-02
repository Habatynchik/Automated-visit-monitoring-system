<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    public $timestamps = false;

    public function user()
    {
    	return $this->belongsTo('App\User', 'id', 'id_user_student');
    }

    public function schedule()
    {
    	return $this->hasOne('App\Schedule', 'id', 'id_schedule');
    }
}
