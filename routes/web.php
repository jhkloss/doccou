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

Route::get('/register', function () {
    return view('auth/register');
})->name('register');

Route::get('/profile', function () {
})->middleware('auth');

Route::get('/courses', function () {
    return view('course/course-overview');
})->middleware('auth')->name('courses');

Route::get('/courses/new', function() {
    return view('course/create-course');
})->middleware('auth')->name('createCourse');

Route::get('/courses/edit/{id}', function($id) {
    return view('course/edit-course')->with('id', $id);
})->middleware('auth', 'checkEditCourse')->name('editCourse');

Route::get('/courses/view/{id}', function($id) {
    return view('course/course-detail')->with('id', $id);
})->middleware('auth')->name('viewCourse');

// Controllers

// Auth
Route::post('/register/create', 'Auth\RegisterController@create')->name('formRegister');
Route::post('/login', 'Auth\LoginController@authenticate')->name('formLogin');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Course
Route::post('/courses/new/create', 'Course\CourseController@create')->name('formNewCourse')->middleware('auth');
Route::post('/courses/edit/save', 'Course\CourseController@edit')->name('formEditCourse')->middleware('auth');
