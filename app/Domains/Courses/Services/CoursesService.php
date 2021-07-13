<?php
namespace App\Domains\Courses\Services;

use App\Course;
use App\Lesson;
use App\Repositories\AccessRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class CoursesService
{
    /**
     * @var AccessRepository
     */
    protected $accessRepository;

    public function __construct(AccessRepository $accessRepository)
    {
        $this->accessRepository = $accessRepository;
    }

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

    public function attachUserToCourse(User $user, Course $course)
    {
        $this->accessRepository->grant($user, $course);
        if (!$user->courses()
            ->where('courses.id', '=', $course->id)
            ->exists()) {
            $user->courses()->attach($course);
        }
    }
}
