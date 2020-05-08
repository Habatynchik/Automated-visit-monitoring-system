<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function group()
    {
    	return $this->belongsTo('App\Group', 'id', 'id_group');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'id', 'id_teacher');
    }
}
