<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class URLGenerationController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Europe/Kiev');
        // date("H:i:s") // время по Киеву
        // date("N") // номер дня недели для поиска по дням
        // date("W")%2 // номер недели, для поиска верхней и нижней недели

        $nowPair = DB::table('schedule_of_disciplines')
            ->whereTime('start_time', '<=', '09:00:00')
            ->whereTime('end_time', '>=', '09:00:00')
            ->select('number')
            ->get();


        $schedules = DB::table('schedules')
            ->where('index_number', $nowPair[0]->number)
            ->where('day', 1)
            ->where('week', 1)
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->select('schedules.id','schedules.index_number','schedules.day', 'classrooms.building_number', 'classrooms.room_number')
            ->get();

        /* $pairs = DB::table('pairs')
             ->join('schedules', 'pairs.id_schedule', '=', 'schedules.id')
             ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
             ->select('pairs.*', 'schedules.*', 'classrooms.*')
             ->get();
        */

        return $schedules;
    }
}
