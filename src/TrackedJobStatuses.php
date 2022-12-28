<?php

namespace Technopers\LaravelTrackableJobs;

class TrackedJobStatuses
{
    const STATUS_QUEUED = 'queued';
    const STATUS_RETRYING = 'retrying';
    const STATUS_STARTED = 'started';
    const STATUS_FINISHED = 'finished';
    const STATUS_FAILED = 'failed';

    const STATUSES = [
        self::STATUS_QUEUED,
        self::STATUS_RETRYING,
        self::STATUS_STARTED,
        self::STATUS_FINISHED,
        self::STATUS_FAILED,
    ];
}