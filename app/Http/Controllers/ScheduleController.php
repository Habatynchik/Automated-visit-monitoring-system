<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule as Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
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
    public function getSchedules()
    {
        return Schedule::all();
    }

    public function execute($method){
        return $this->{$method}();
    }

    public function getSchedule(){
        return Schedule::where('id', request('id'))->get()[0];
    }

    public function getScheduleLink(){
        return Schedule::getScheduleLink();
    }

    public function generateScheduleLink(){
        return Schedule::generateScheduleLink();
    }

    public function getGroupScheduleForDay(){
        return Schedule::where('day', request('day'))
            ->where('week', request('week'))
            ->get();
    }
}
