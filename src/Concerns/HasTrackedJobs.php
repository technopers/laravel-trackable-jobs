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
}