<?php

namespace Technopers\LaravelTrackableJobs\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Technopers\LaravelTrackableJobs\Models\TrackedJob;
use Technopers\LaravelTrackableJobs\TrackedJobStatuses;

trait HasTrackedJobs
{
    public function trackedJobs(): MorphMany
    {
        return $this->morphMany(TrackedJob::class, 'trackable');
    }

    public function getFinishedJobs(): MorphMany
    {
        return $this->morphMany(TrackedJob::class, 'trackable')
            ->where('status', TrackedJobStatuses::STATUS_FINISHED);
    }

    public function getRunningJobs(): MorphMany
    {
        return $this->morphMany(TrackedJob::class, 'trackable')
            ->where('status', TrackedJobStatuses::STATUS_STARTED);
    }

    public function getPendingJobs(): MorphMany
    {
        return $this->morphMany(TrackedJob::class, 'trackable')
            ->where('status', TrackedJobStatuses::STATUS_QUEUED);
    }

    public function getFailedJobs(): MorphMany
    {
        return $this->morphMany(TrackedJob::class, 'trackable')
            ->where('status', TrackedJobStatuses::STATUS_FAILED);
    }
}