<?php
namespace App\Listeners;

use App\Events\UserFinishedLessonEvent;
use App\Services\RankingService;
use App\User;

class GrantPointsForFinishedLessonListener
{
    /** @var RankingService */
    protected $service;

    /**
     * Create the event listener.
     */
    public function __construct(RankingService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     */
    public function handle(UserFinishedLessonEvent $event)
    {
        $this->service->grant(User::find($event->userId), config('rating.lesson'));
    }
}
