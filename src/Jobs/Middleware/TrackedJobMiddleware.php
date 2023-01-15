<?php

namespace Technopers\LaravelTrackableJobs\Jobs\Middleware;

use Technopers\LaravelTrackableJobs\Contracts\TrackableJobCallbacks;

class TrackedJobMiddleware
{
    public function handle($job, $next): void
    {
        $job->trackedJob->markAsStarted();

        if ($job instanceof TrackableJobCallbacks) {
            $job->started();
        }

        try {
            $response = $next($job);
            if ($job->job->isReleased()) {
                $job->trackedJob->markAsRetrying();
            } else {
                $job->trackedJob->markAsFinished($response);
                if ($job instanceof TrackableJobCallbacks) {
                    $job->finished();
                }
            }
        } catch (\Throwable $exception) {
            $job->trackedJob->markAsFailed($exception->getMessage());
            if ($job instanceof TrackableJobCallbacks) {
                $job->failed();
            }
        }
    }
}