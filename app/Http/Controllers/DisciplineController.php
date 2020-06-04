<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discipline_list as Discipline_list;

class DisciplineController extends Controller
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
    public function getDisciplines()
    {
        return Discipline_list::all();
    }

    public function execute($method){
        return $this->{$method}();
    }

    public function getDiscipline(){
        return Discipline_list::where('id', request('id'))->get()[0];
    }
}
