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

//Views

Route::get('/', function () {
   return view('main');
})->name('main');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard')->middleware('auth');


Route::post('/getusers', 'User\UserController@getUsersJSON');

