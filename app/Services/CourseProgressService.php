<?php
namespace App\Services;

use App\Course;
use App\User;

class CourseProgressService
{
    public function progress(User $user, Course $course) : float
    {
        $totalItems = $this->total($course);

        if ($totalItems == 0) {
            return 0.0;
        }

        $finishedItems = $this->finished($user, $course);

        return (float) ($finishedItems / $totalItems);
    }

    public function total(Course $course) : int
    {
        return $course->lessons->count()
            + $course->quizzes->count();
    }

    public function finished(User $user, Course $course) : int
    {
        $lessonsIds = $course->lessons->pluck('id');
        $quizzesIds = $course->quizzes->pluck('id');

        $userLessonsCount = $user->lessons()
            ->whereIn('lessons.id', $lessonsIds)
            ->wherePivot('finished_at', '!=', null)
            ->count();
        $userQuizzesCount = $user->quizzes()
            ->whereIn('quizzes.id', $quizzesIds)
            ->wherePivot('is_pass', 'true')
            ->count();

        return $userLessonsCount + $userQuizzesCount;
    }
}
