<?php
namespace App\Domains\Courses\Services;

use App\Course;
use App\Lesson;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class CoursesService
{
    public function hasStartedCourseAt(User $user, Course $course) : ?Carbon
    {
        $userCourse = $user->courses()
            ->where('courses.id', $course->id)
            ->first();

        if ($userCourse === null) {
            return null;
        }

        return $userCourse->pivot->created_at;
    }

    public function canViewLesson(User $user, Course $course, Lesson $lesson) : bool
    {
        if ($course->isSpecialAccess() || $course->isSystematic()) {
            return $course->visibleLessons($user)
                ->where('lessons.id', $lesson->id)
                ->exists();
        }

        return Gate::allows('access', $course);
    }
}
