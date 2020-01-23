<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('course/course-overview', 'App\Composers\CourseOverviewComposer');
        View::composer('course/course-detail', 'App\Composers\CourseDetailComposer');
        View::composer('course/edit-course', 'App\Composers\CourseEditComposer');
    }
}
