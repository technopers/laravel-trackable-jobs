# Laravel Trackable Jobs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/technopers/laravel-trackable-jobs.svg?style=flat-square)](https://packagist.org/packages/technopers/laravel-trackable-jobs)
[![Total Downloads](https://img.shields.io/packagist/dt/technopers/laravel-trackable-jobs.svg?style=flat-square)](https://packagist.org/packages/technopers/laravel-trackable-jobs)
![GitHub Actions](https://github.com/technopers/laravel-trackable-jobs/actions/workflows/main.yml/badge.svg)

Laravel trackable jobs is simple yet affective library for tracking background processes by Model entry (row).

## Installation

You can install the package via composer:

```bash
composer require technopers/laravel-trackable-jobs
```

## Usage

You have a process called compress user profile picture. Which is related to specific user. So
your job will be

```php
class CompressUserProfilePicture {
    
}
``` 

This job can easily be tracked by each user, You can have status of this process, What you need to do is that.

### Just add trait called "Trackable" and pass model object

```php
class CompressUserProfilePicture 
{
    use Trackable {
        Trackable::__construct as __trackableConstruct;
    };
    
    public $user;
    
    public function __construct($user)
    {
        $this->user = $user;
        $this->__trackableConstruct($user);
    }
}
```

### Find processes by user

#### Get processes by User

For that add, Just add trait called "HasTrackedJobs"

```php
use HasTrackedJobs;
```

It will add relations and give you finding methods like,

```php
public function trackedJobs(): MorphMany
{
    return $this->morphMany(TrackedJob::class, 'trackable');
}

public function finishedJobs(): MorphMany
{
    return $this->morphMany(TrackedJob::class, 'trackable')
        ->where('status', TrackedJobStatuses::STATUS_FINISHED);
}

public function failedJobs(): MorphMany
{
    return $this->morphMany(TrackedJob::class, 'trackable')
        ->where('status', TrackedJobStatuses::STATUS_FAILED);
}

public function runningJobs(): MorphMany
{
    return $this->morphMany(TrackedJob::class, 'trackable')
        ->where('status', TrackedJobStatuses::STATUS_STARTED);
}

public function pendingJobs(): MorphMany
{
    return $this->morphMany(TrackedJob::class, 'trackable')
        ->where('status', TrackedJobStatuses::STATUS_QUEUED);
}
```

#### Also, if you have single job by each model

For that add, Just add trait called **"HasTrackedJob"** not "HasTrackedJobs"

```php
use HasTrackedJob;
```

Which has methods like,

```php
public function trackedJob(): MorphOne
{
    return $this->morphOne(TrackedJob::class, 'trackable');
}

public function finishedJobs(): MorphOne
{
    return $this->morphOne(TrackedJob::class, 'trackable')
        ->where('status', TrackedJobStatuses::STATUS_FINISHED);
}

public function failedJobs(): MorphOne
{
    return $this->morphOne(TrackedJob::class, 'trackable')
        ->where('status', TrackedJobStatuses::STATUS_FAILED);
}

public function runningJobs(): MorphOne
{
    return $this->morphOne(TrackedJob::class, 'trackable')
        ->where('status', TrackedJobStatuses::STATUS_STARTED);
}

public function pendingJobs(): MorphOne
{
    return $this->morphOne(TrackedJob::class, 'trackable')
        ->where('status', TrackedJobStatuses::STATUS_QUEUED);
}
```

## Usage

### Fetch processes

```php
$userProcesses = $user->trackedJob()->get();
```

or

```php
$userProcesses = $user->trackedJob;
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hardik@technopers.com instead of using the issue tracker.

## Credits

-   [Hardik Modha](https://github.com/technopers)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.