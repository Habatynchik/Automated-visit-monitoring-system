<?php

namespace App;

use Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User as User;

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

        return "http://automated-visit-monitoring-sys.herokuapp.com/api/schedule/registerForPair" . $scheduleLink->link;
    }

    public static function generateScheduleLink(){
        $date = date("Y-m-d");
        date_default_timezone_set('Europe/Kiev');
        $link = '?building_number=' . request('building') . '&room_number=' . request('room');

        $nowPair = DB::table('schedule_of_disciplines')
                ->whereTime('start_time', '<=', '17:00:00') // date("H:i:s")
                ->whereTime('end_time', '>=', '17:00:00') // date("H:i:s")
                ->select('number')
                ->get();

        DB::table('schedules')
            ->where('schedules.index_number', 1)
            ->where('schedules.day', 1) // date("N")
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->where('classrooms.building_number', request('building'))
            ->where('classrooms.room_number', request('room'))
            ->update(['schedules.link' => $link]);

        $groupsID = DB::table('schedules')
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->where('day', 1) // date("N")
            ->where('week', 1)
            ->where('classrooms.building_number', request('building'))
            ->where('classrooms.room_number', request('room'))
            ->select('schedules.id_group', 'schedules.id')
            ->get();

        foreach($groupsID as $groupID){
            $groupStudents = User::where('id_group', $groupID->id)
                ->get();

            $query = [];

            foreach($groupStudents as $student){
                $query[] = ['id_user_student' => $student->id, 'id_schedule' => $groupID->id, 'arrive_time' => null, 'date' => $date, 'status_change_teacher' => 0];
            }

            DB::table('pairs')->insert($query);
        }

        return $link;
    }
}
