<?php

Route::post('/docker/image/build', 'Docker\DockerController@buildImage')->middleware('auth');

Route::post('/docker/container/create', 'Docker\DockerController@createCourseContainers')->middleware('auth');

Route::post('/docker/container/start', 'Docker\DockerController@startContainer')->middleware('auth');

Route::post('/docker/container/stop', 'Docker\DockerController@stopContainer')->middleware('auth');
