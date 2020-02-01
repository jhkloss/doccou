<?php

namespace App\Providers;

use App\Services\DockerService;
use Illuminate\Support\ServiceProvider;

class DockerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\DockerService', function($app)
        {
            return new DockerService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Assign Composers
    }
}
