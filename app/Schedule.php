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
                ->whereTime('start_time', '<=', date("H:i:s")) // date("H:i:s")
                ->whereTime('end_time', '>=', date("H:i:s")) // date("H:i:s")
                ->select('number')
                ->get();

        $check = DB::table('schedules')
            ->where('schedules.index_number', $nowPair[0]->number)
            ->where('schedules.day', date("N")) // date("N")
            ->where('week', 1) // date("W")%2
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->where('classrooms.building_number', request('building'))
            ->where('classrooms.room_number', request('room'))
            ->select('schedules.link')
            ->get()[0];

        if ($check->link != null) {
            return "http://automated-visit-monitoring-sys.herokuapp.com/api/schedule/registerForPair".$check->link;
        }

        DB::table('schedules')
            ->where('schedules.index_number', $nowPair[0]->number)
            ->where('schedules.day', date("N")) // date("N")
            ->where('week', 1) // date("W")%2
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->where('classrooms.building_number', request('building'))
            ->where('classrooms.room_number', request('room'))
            ->update(['schedules.link' => $link]);



        $groupsID = DB::table('schedules')
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->where('day', date("N")) // date("N")
            ->where('week', 1)
            ->where('classrooms.building_number', request('building'))
            ->where('classrooms.room_number', request('room'))
            ->select('schedules.id_group', 'schedules.id')
            ->get();

        foreach($groupsID as $groupID){
            $groupStudents = User::where('id_group', $groupID->id_group)
                ->get();

            $query = [];

            foreach($groupStudents as $student){
                $query[] = ['id_user_student' => $student->id, 'id_schedule' => $groupID->id, 'arrive_time' => null, 'date' => $date, 'status_change_teacher' => 0];
            }


        }


        DB::table('pairs')->insert($query);

        return "http://automated-visit-monitoring-sys.herokuapp.com/api/schedule/registerForPair".$link;
    }
}
