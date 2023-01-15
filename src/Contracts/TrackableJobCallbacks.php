<?php

namespace Technopers\LaravelTrackableJobs\Contracts;

interface TrackableJobCallbacks
{
    public function queued(): void;

    public function started(): void;

    public function finished(): void;

    public function failed(): void;
}