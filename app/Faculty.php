<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function groups()
    {
    	return $this->hasMany('App\Group', 'id_faculty', 'id');
    }
}
