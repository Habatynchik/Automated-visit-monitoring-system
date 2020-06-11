<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PairController;
use UserController;

class RouteController extends Controller
{
    public function call($controller, $method){
        $className = "App\Http\Controllers\\" . ucfirst($controller) . "Controller";
        $controller = new $className;

        return $controller->execute($method);
    }
}
