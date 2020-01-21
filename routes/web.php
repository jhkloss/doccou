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

//Views

Route::get('/', function () {
   return view('test');
});

Route::get('register', function () {
    return view('auth/register');
});

Route::get('/profile', function () {
})->middleware('auth');

Route::get('/profile', function () {
})->middleware('auth');

Route::get('/courses', function () {
    return view('course/course-overview');
})->middleware('auth');

// Controllers

Route::post('/register/create', 'Auth\RegisterController@create');
Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
