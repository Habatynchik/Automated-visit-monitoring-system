<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom as Classroom;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getClassrooms()
    {
        if(request('by')){
            return Classroom::where(request('by'), request('value'))->get();
        } else {
            return Classroom::all();
        }
    }

    public function execute($method){
        return $this->{$method}();
    }

    public function getClassroom(){
        return Classroom::where('id', request('id'))->get()[0];
    }

    public function getBuildings(){
        return Classroom::select('building_number')->groupBy('building_number')->get();
    }
}
