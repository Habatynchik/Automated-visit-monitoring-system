<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function group()
    {
    	return $this->hasMany('groups', 'id_department', 'id');
    }
}
