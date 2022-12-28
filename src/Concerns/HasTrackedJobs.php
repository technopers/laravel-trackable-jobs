<?php

namespace Technopers\LaravelTrackableJobs\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Technopers\LaravelTrackableJobs\Models\TrackedJob;

trait HasTrackedJobs
{
    public function trackedJobs(): MorphMany
    {
        return $this->morphMany(TrackedJob::class, 'trackable');
    }
}