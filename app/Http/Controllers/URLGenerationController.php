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
        $pairs = DB::table('pairs')
            ->join('schedules', 'pairs.id_schedule', '=', 'schedules.id')
            ->join('classrooms', 'schedules.id_classroom', '=', 'classrooms.id')
            ->select('pairs.*', 'schedules.*', 'classrooms.*')
            ->get();

        return $pairs;
    }
}
