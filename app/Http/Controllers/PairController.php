<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pair as Pair;

class PairController extends Controller
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
    public function getPairs()
    {
        return Pair::all();
    }

    public function execute($method, $data = null){
        return $this->{$method}($data);
    }

    public function getPair($data){
        return Pair::where('id', $data)->get()[0];
    }
}
