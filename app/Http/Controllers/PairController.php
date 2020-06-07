<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pair as Pair;
use Illuminate\Support\Facades\DB;

class PairController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPairs()
    {
        return Pair::all();
    }

    public function execute($method)
    {
        return $this->{$method}();
    }

    public function getPair()
    {
        return Pair::where('id', request('id'))->get()[0];
    }

    public function getNowPairByTeacher()
    {
        $idTeacher = request("idTeacher");

        date_default_timezone_set('Europe/Kiev');

        // date("H:i:s");// время по Киеву
        // date("N") // номер дня недели для поиска по дням
        // date("W")%2 // номер недели, для поиска верхней и нижней недели

        $nowPair = DB::table('schedule_of_disciplines')
            ->whereTime('start_time', '<=', '09:00:00') // date("H:i:s")
            ->whereTime('end_time', '>=', '09:00:00') // date("H:i:s")
            ->select('number')
            ->get();

        $nowPairByRoom =

          /* DB::table('discipline_lists')
            //->where('id', 1)
            ->select()
            ->get();*/
        DB::table('schedules')
            ->where('index_number', $nowPair[0]->number)
            ->where('day', 1) // date("N")
            ->where('week', 1) // date("W")%2
            ->where('id_teacher', $idTeacher)
            ->join('groups', 'schedules.id_group', '=', 'groups.id')
            ->join('users', 'groups.id', '=', 'users.id_group')
            ->join('pairs', 'users.id', '=', 'pairs.id_user_student')
            ->where('pairs.date', "2020-05-20")
            ->join('discipline_lists', 'schedules.id_disciplines', '=', 'discipline_lists.id')
            ->select('discipline_lists.name AS discipline_name' , 'users.surname', 'users.name', 'users.second_name', 'groups.name AS group_name' , 'pairs.arrive_time')
            ->get();

        return $nowPairByRoom;
    }

}
