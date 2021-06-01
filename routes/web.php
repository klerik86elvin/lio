<?php

use App\Mail\AssignedToMessage;
use Illuminate\Support\Facades\Mail;
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
    if(auth()->guard('employee_api')->check())
    {
//        $user = auth()->guard('employee_api')->user()->name;
//        \App\Jobs\SendMail::dispatch($user)->delay(now()->addSeconds(4));
    }
//    return 'ok';
//    Mail::to('elvin.m9292@gmail.com')->send(new AssignedToMessage());
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
