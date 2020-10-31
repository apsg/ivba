<?php

namespace App\Policies;

use App\Course;
use App\Repositories\AccessRepository;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the course.
     */
    public function view(User $user, Course $course)
    {
        return $user->hasFullAccess() || $course->hasAccess($user->id);
    }

    public function access(User $user, Course $course)
    {
        if ($course->isSpecialAccess()) {
            return $this->specialAccess($user, $course);
        }

        if ($user->hasFullAccess()) {
            return true;
        }

        if ($course->hasAccess($user->id)) {
            return true;
        }

        return false;
    }

    private function specialAccess(User $user, Course $course)
    {
        return app(AccessRepository::class)
            ->has($user, $course);
    }
}
