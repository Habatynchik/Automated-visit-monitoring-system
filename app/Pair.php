<?php

namespace App;

use Illuminate\Support\Facades\DB;
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

    public static function updatePresence($building, $room){
        date_default_timezone_set('Europe/Kiev');

        $nowPair = DB::table('schedule_of_disciplines')
            ->whereTime('start_time', '<=', "09:00:00") // date("H:i:s")
            ->whereTime('end_time', '>=', "09:00:00") // date("H:i:s")
            ->select('number')
            ->get();

        $pair = DB::table('pairs')
            ->join('schedules', 'pairs.id_schedule', '=', 'schedules.id')
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->where('pairs.date', date('Y-m-d'))
            ->where('pairs.id_user_student', auth()->user()->id)
            ->where('schedules.index_number', $nowPair[0]->number)
            ->where('classrooms.building_number', $building)
            ->where('classrooms.room_number', $room)
            ->update(['arrive_time' => date("H:i:s")]);
    }
}
