<?php

use App\Task;
use Illuminate\Support\Facades\Route;

Route::get('task/edit/{id}', function($id){
    return view('task/edit-task')
        ->with('task', Task::find($id));
})->middleware('auth')->name('editTask');

Route::get('task/view/{id}', function($id){
    return view('task/task-detail')
        ->with('task', Task::find($id));
})->middleware('auth')->name('viewTask');

Route::post('/task/add', 'Task\TaskController@add')->middleware('auth');

Route::post('/task/edit/save', 'Task\TaskController@edit')->name('formEditTask')->middleware('auth');
