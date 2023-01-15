<?php

namespace Technopers\LaravelTrackableJobs\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Technopers\LaravelTrackableJobs\Models\TrackedJob;
use Technopers\LaravelTrackableJobs\TrackedJobStatuses;

/**
 * @mixin Model
 */
trait HasTrackedJob
{
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
}