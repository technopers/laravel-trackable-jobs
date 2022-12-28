<?php

namespace Technopers\LaravelTrackableJobs;

use Illuminate\Support\ServiceProvider;

class LaravelTrackableJobsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-trackable-jobs');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-trackable-jobs');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/trackable-jobs.php' => config_path('trackable-jobs.php')
            ], 'trackable-jobs-configs');
        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
