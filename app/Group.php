<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
    	return $this->hasMany('App\Users', 'id_group', 'id');
    }

    public function faculty()
    {
    	return $this->hasOne('App\Faculty', 'id', 'id_faculty');
    }

    public function department()
    {
    	return $this->hasOne('App\Department', 'id', 'id_department');
    }

    public function schedule()
    {
    	return $this->hasMany('App\Schedule', 'id_group', 'id');
    }
}
