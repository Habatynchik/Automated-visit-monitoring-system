<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department as Department;

class DepartmentController extends Controller
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
    public function getDepartments()
    {
        if(request('by')){
            return Department::where(request('by'), request('value'))->get();
        } else {
            return Department::all();
        }
    }

    public function execute($method){
        return $this->{$method}();
    }
}
