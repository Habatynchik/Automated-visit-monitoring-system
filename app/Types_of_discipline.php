<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types_of_discipline extends Model
{
    public function schedule()
    {
    	return $this->hasMany('App\Schedule', 'id_disciplines', 'id');
    }
}
