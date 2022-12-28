<?php

return [
    /*
     | The table where the tracked jobs will be stored.
     | By default, it's called 'tracked_jobs'.
     */
    'tables' => [
        'tracked_jobs' => 'tracked_jobs',
    ],

    /*
     | The model which will be used for accessing tracked_jobs table.
     | By default, it's \Technopers\LaravelTrackableJobs\Models\TrackedJob::class.
     */
    'models' => [
        'tracked_job_model' => \Technopers\LaravelTrackableJobs\Models\TrackedJob::class,
    ],
];