<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function groups()
    {
    	return $this->hasMany('App\Faculty', 'id_department', 'id');
    }
}
