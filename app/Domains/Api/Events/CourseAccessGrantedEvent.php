<?php
namespace App\Domains\Api\Events;

use App\Course;
use App\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourseAccessGrantedEvent
{
    use Dispatchable, SerializesModels;

    /** @var User */
    public $user;

    /** @var Course */
    public $course;

    public function __construct(User $user, Course $course)
    {
        $this->user = $user;
        $this->course = $course;
    }
}
