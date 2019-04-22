<?php

namespace App\Policies;

use App\Lesson;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the lesson.
     *
     * @param \App\User   $user
     * @param \App\Lesson $lesson
     * @return mixed
     */
    public function view(User $user, Lesson $lesson)
    {
        //
    }

    public function access(User $user, Lesson $lesson)
    {
        if ($user->hasFullAccess()) {
            return true;
        }

        if ($lesson->hasCourseAccess($user->id)) {
            return true;
        }

        if ($lesson->hasAccess($user->id)) {
            return true;
        }

        return false;
    }
}
