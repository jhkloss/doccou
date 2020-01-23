<?php

use Illuminate\Support\Facades\Route;

Route::get('/profile', function () {
})->middleware('auth');

Route::post('/register/create', 'Auth\RegisterController@create')->name('formRegister');

Route::post('/login', 'Auth\LoginController@authenticate')->name('formLogin');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
