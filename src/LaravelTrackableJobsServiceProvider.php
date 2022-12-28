<?php

namespace Technopers\LaravelTrackableJobs;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTrackableJobsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
          * This class is a Package Service Provider
          *
          * More info: https://github.com/spatie/laravel-package-tools
          */
        $package
            ->name('trackable-jobs')
            ->hasConfigFile('trackable-jobs')
            ->hasMigration('create_tracked_jobs_table');
    }
}
