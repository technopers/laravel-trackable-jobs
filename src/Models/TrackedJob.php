<?php

namespace Technopers\LaravelTrackableJobs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Technopers\LaravelTrackableJobs\Contracts\TrackableJobContract;
use Technopers\LaravelTrackableJobs\TrackedJobStatuses;

class TrackedJob extends Model implements TrackableJobContract
{
    protected $fillable = [
        'trackable_id',
        'trackable_type',
        'name',
        'status',
        'output',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('trackable-jobs.tables.tracked_jobs', 'tracked_jobs'));
    }

    public function trackable(): MorphTo
    {
        return $this->morphTo('trackable', 'trackable_type', 'trackable_id');
    }

    public function markAsStarted(): bool
    {
        return $this->update([
            'status' => TrackedJobStatuses::STATUS_STARTED,
            'started_at' => now(),
        ]);
    }

    public function markAsQueued(): bool
    {
        return $this->update([
            'status' => TrackedJobStatuses::STATUS_QUEUED,
        ]);
    }

    public function markAsRetrying(): bool
    {
        return $this->update([
            'status' => TrackedJobStatuses::STATUS_RETRYING,
        ]);
    }

    public function markAsFinished(string $message = null): bool
    {
        if ($message) {
            $this->setOutput($message);
        }

        return $this->update([
            'status' => TrackedJobStatuses::STATUS_FINISHED,
            'finished_at' => now(),
        ]);
    }

    public function markAsFailed(string $exception = null): bool
    {
        if ($exception) {
            $this->setOutput($exception);
        }

        return $this->update([
            'status' => TrackedJobStatuses::STATUS_FAILED,
            'finished_at' => now(),
        ]);
    }

    public function setOutput(string $output): bool
    {
        return $this->update([
            'output' => $output,
        ]);
    }

    /**
     * Whether the job has already started.
     * @return bool
     */
    public function hasStarted(): bool
    {
        return !empty($this->started_at);
    }
}