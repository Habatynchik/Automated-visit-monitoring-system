<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group as Group;

class GroupController extends Controller
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
    public function getGroups()
    {
        return Group::all();
    }

    public function execute($method, $data = null){
        return $this->{$method}($data);
    }

    public function getGroup($data){
        return Group::where('id', $data)->get()[0];
    }
}
