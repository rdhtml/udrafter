<?php

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
    return view('auth.login');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', ['as' => 'home', 'uses' =>'HomeController@index']);

    Route::post('/update-student-status/', ['as' => 'update.student.status', 'uses' =>'HomeController@updateStudentStatus']);


});
