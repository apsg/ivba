<?php

namespace App\Listeners;

use App\Events\UserHasPassedQuizEvent;
use App\Services\RankingService;

class GrantPointsForPassedQuizListener
{
    /** @var RankingService */
    public $service;

    public function __construct(RankingService $service)
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
