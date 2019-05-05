<?php

namespace App\Listeners;

use App\Events\UserFinishedLessonEvent;
use App\Events\UserHasPassedQuizEvent;
use App\Helpers\ProgressHelper;
use Cache;

class InvalidateCachedProgressListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof UserFinishedLessonEvent) {
            Cache::forget(ProgressHelper::cacheKeyById($event->userId, $event->courseId));
        }

        if ($event instanceof UserHasPassedQuizEvent) {
            Cache::forget(ProgressHelper::cacheKey($event->user, $event->quiz->course ?? null));
        }
    }
}
