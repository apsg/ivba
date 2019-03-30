<?php
namespace App\Listeners;

use App\Events\UserFinishedLessonEvent;
use App\Services\PointsService;
use App\User;

class GrantPointsForFinishedLessonListener
{
    /** @var PointsService */
    protected $service;

    /**
     * Create the event listener.
     */
    public function __construct(PointsService $service)
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
