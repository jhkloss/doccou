<?php

use Illuminate\Support\Facades\Route;

Route::post('/charts/general', 'Chart\ChartController@generalChart');
