<?php
namespace App\Domains\Courses\Services;

use App\Course;
use App\User;
use Carbon\Carbon;

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
}
