<?php

namespace App;

use Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    public $timestamps = false;

    public function group()
    {
    	return $this->belongsTo('App\Group', 'id', 'id_group');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'id', 'id_teacher');
    }

    public function pairs()
    {
        return $this->hasOne('App\Pair', 'id_schedule', 'id');
    }

    public static function getScheduleLink(){
        $scheduleLink = DB::table('schedules')
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->where('classrooms.building_number', request('building'))
            ->where('classrooms.room_number', request('room'))
            ->select('schedules.link')
            ->get()[0];

        return "http://127.0.0.1:8000/api/schedule/registrForPair" . $scheduleLink->link;
    }

    public static function generateScheduleLink(){

        DB::table('schedules')
            ->where('id_disciplines', request('id_disciplines'))
            ->where('id_teacher', request('id_teacher'))
            ->where('id_group', request('id_group'))
            ->update(['link' => '?building_number=' . request('building') . '&room_number=' . request('room')]);
    }
}
