<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline_list extends Model
{
    public function schedules()
    {
    	return $this->hasMany('App\Schedule', 'id_disciplines', 'id');
    }
}
