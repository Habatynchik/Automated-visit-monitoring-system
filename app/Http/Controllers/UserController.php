<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use App\Group as Group;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
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

    public function execute($method){
        return $this->{$method}();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getUser(){
        return User::where('id',request('id'))->get()[0];
    }

    public function getTeachers(){
        return User::where('type', '1')->get();
    }

    public function store(){

        if (request('type') == '1') {
            $this->validate(request(), [
                'name' => 'required|min:2',
                'surname' => 'required|min:2',
                'second_name' => 'required|min:2',
            ]);

            $group = null;
        } else if(request('type') == '0'){
            $this->validate(request(), [
                'name' => 'required|min:2',
                'surname' => 'required|min:2',
                'second_name' => 'required|min:2',
                'group' => 'required'
            ]);

            $group = Group::where('name', request('group'))->get()[0]->id;
        }

        $user = new User;
        $user->name = request('name');
        $user->surname = request('surname');
        $user->second_name = request('second_name');
        $user->birth_date = request('date');
        $user->id_group = $group;
        $user->type = request('type');
        $user->email = $user->name . $user->surname . $user->second_name . "@temp";
        $user->password = Hash::make($user->name . $user->surname . $user->second_name);
        $user->save();

        return true;
    }
}
