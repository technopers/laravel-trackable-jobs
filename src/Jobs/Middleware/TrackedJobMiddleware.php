<?php

namespace Technopers\LaravelTrackableJobs\Jobs\Middleware;

class TrackedJobMiddleware
{
    public function handle($job, $next): void
    {
        $job->trackedJob->markAsStarted();

        try {
            $response = $next($job);
            if ($job->job->isReleased()) {
                $job->trackedJob->markAsRetrying();
            } else {
                $job->trackedJob->markAsFinished($response);
            }
        } catch (\Throwable $exception) {
            $job->trackedJob->markAsFailed($exception->getMessage());
        }
    }
}