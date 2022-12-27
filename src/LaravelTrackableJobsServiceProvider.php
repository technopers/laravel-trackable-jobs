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
        /*
         * Optional methods to load your package assets
         */

        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-trackable-jobs');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-trackable-jobs');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php'
            ]);
        }
    }
}
