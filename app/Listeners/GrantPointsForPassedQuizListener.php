<?php

namespace App\Listeners;

use App\Events\UserHasPassedQuizEvent;
use App\Services\PointsService;

class GrantPointsForPassedQuizListener
{
    /** @var PointsService */
    public $service;

    public function __construct(PointsService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(UserHasPassedQuizEvent $event)
    {
        $this->service->grant($event->user, config('rating.quiz'));
    }
}
