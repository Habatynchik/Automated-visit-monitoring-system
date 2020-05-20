<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;

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

    public function execute($method, $data = null){
        return $this->{$method}($data);
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getUser($data){
        return User::where('id', $data)->get()[0];
    }
}
