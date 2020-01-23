<?php

use Illuminate\Support\Facades\Route;

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

Route::post('/courses/new/create', 'Course\CourseController@create')->name('formNewCourse')->middleware('auth');

Route::post('/courses/edit/save', 'Course\CourseController@edit')->name('formEditCourse')->middleware('auth');

// TASK MANAGEMENT

Route::post('/courses/{courseID}/member/add', 'Course\CourseController@addMember')->name('addMember')->middleware('auth');
Route::post('/courses/{courseID}/member/remove', 'Course\CourseController@removeMember')->name('addMember')->middleware('auth');
