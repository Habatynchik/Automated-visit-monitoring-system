<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('test');
});

Route::get('/test', function(){
	return Group::where('id', $data)->get()[0];
});

Route::get('/admin/newUsers', function(){
    return view('admin/register');
});

Route::any('/api/{controller}/{method}/{data?}', 'RouteController@call');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/generate', 'URLGenerationController@index');
