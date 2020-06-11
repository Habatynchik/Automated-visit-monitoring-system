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
    return view('home');
})->name('home');

Route::get('/pairstudentlist', function(){
    return view('pairstudentlist');
})->name('pairstudentlist');

Route::get('/getStudentTraffic', function(){
    return view('studentTraffic');
})->name('studentTraffic');

Route::get('/admin/editSchedule', function(){
    return view('editSchedule');
})->name('editSchedule');

Route::get('/getTest', 'PairController@getStudentTrafficByGroupAndDisciplines'); // ?idGroup=1&idDisciplines=1

Route::get('/admin/newUsers', function(){
    return view('admin/register');
})->name('register_users');

Route::any('/api/{controller}/{method}', 'RouteController@call');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
