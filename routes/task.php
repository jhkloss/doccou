<?php

use App\Task;

Route::get('tasks', function(){
    return view('task/task-overview');
})->middleware('auth')->name('tasks');

Route::get('task/edit/{id}', function($id){
    return view('task/edit-task')
        ->with('task', Task::find($id));
})->middleware('auth')->name('editTask');

Route::get('task/view/{id}', function($id){
    if(\App\Http\Controllers\Task\TaskController::canEdit($id))
    {
        return view('task/task-detail')
            ->with('task', Task::find($id));
    }
    else
    {
        return view('task/task-info')
            ->with('task', Task::find($id));
    }
})->middleware('auth')->name('viewTask');

Route::post('/task/add', 'Task\TaskController@add')->middleware('auth');

Route::post('/task/edit/save', 'Task\TaskController@edit')->name('formEditTask')->middleware('auth');

Route::post('/task/dockerfile/save/{taskID}', 'Task\TaskController@uploadDockerfile')->name('uploadDockerfile')->middleware('auth');
