<?php
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserFinishedLessonEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var int */
    public $userId;

    /** @var int */
    public $courseId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $userId, int $courseId = null)
    {
        $this->userId = $userId;
        $this->courseId = $courseId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
