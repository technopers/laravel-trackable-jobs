<?php

namespace Technopers\LaravelTrackableJobs\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Technopers\LaravelTrackableJobs\Contracts\TrackableJobCallbacks;
use Technopers\LaravelTrackableJobs\Jobs\Middleware\TrackedJobMiddleware;

trait Trackable
{
    public Model $model;
    public Builder|Model $trackedJob;

    public ?string $name;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $trackable_model = config('trackable-jobs.models.tracked_job_model');
        $this->trackedJob = ($trackable_model)::query()->create([
            'trackable_id' => $this->model->id,
            'trackable_type' => $this->model->getMorphClass(),
            'name' => $this->name ?? class_basename(static::class),
        ]);
        if ($this instanceof TrackableJobCallbacks) {
            $this->queued();
        }
    }

    public function middleware(): array
    {
        return [new TrackedJobMiddleware()];
    }
}