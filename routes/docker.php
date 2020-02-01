<?php

Route::post('/docker/image/build', 'Docker\DockerController@buildImage')->middleware('auth');

Route::post('/docker/container/create', 'Docker\DockerController@createCourseContainers')->middleware('auth');
