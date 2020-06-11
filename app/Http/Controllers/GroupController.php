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
        if(request('by')){
            return Group::where(request('by'), request('value'))->get();
        } else {
            return Group::all();
        }
    }

    public function execute($method){
        return $this->{$method}();
    }

    public function getGroupById(){
        return Group::where('id', request('id'))->get();
    }

    public function getGroupByName(){
        return Group::where('name', request('name'))->get()[0];
    }
}
