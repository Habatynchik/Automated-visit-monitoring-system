<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty as Faculty;

class FacultyController extends Controller
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
    public function getFaculties()
    {
        if(request('by')){
            return Faculty::where(request('by'), request('value'))->get();
        } else {
            return Faculty::all();
        }
    }

    public function execute($method){
        return $this->{$method}();
    }
}
