<?php

namespace App\Providers;

use App\Services\DockerService;
use Illuminate\Support\ServiceProvider;

class MessageServiceProviderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\MessageService', function($app)
        {
            return new \MessageService();
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
