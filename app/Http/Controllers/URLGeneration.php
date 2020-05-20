<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class URLGeneration extends Controller
{
    public function index()
    {
        /* $pairs = DB::table('pairs')
             ->join('schedules', 'pairs.id_schedule', '=', 'schedules.id')
             ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
             ->select('pairs.*', 'schedules.*', 'classrooms.*')
             ->get();
 */
        $pairs = DB::table('schedules')
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->select('schedules.*', 'classrooms.*')
            ->get();

        return view('pairs.index', ['pairs' => $pairs]);
    }
}
