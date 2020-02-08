<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Assign Composers

        View::composer('main', 'App\Composers\MainComposer');
        View::composer('course/course-overview', 'App\Composers\CourseOverviewComposer');
        View::composer('course/course-detail', 'App\Composers\CourseDetailComposer');
        View::composer('course/edit-course', 'App\Composers\CourseEditComposer');
        View::composer('dashboard/dashboard', 'App\Composers\DashboardComposer');
        View::composer('task/task-detail', 'App\Composers\TaskDetailComposer');
        View::composer('task/task-info', 'App\Composers\TaskViewComposer');
        View::composer('task/task-overview', 'App\Composers\TaskOverviewComposer');
        View::composer('partials/menu', 'App\Composers\MenuComposer');
    }
}
