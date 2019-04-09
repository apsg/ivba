<?php
namespace App\Services;

use App\Course;
use App\Lesson;
use App\User;

class LastLessonService
{
    public function get(User $user)
    {
        $lesson = $user->lessons()
            ->orderBy('lesson_user.updated_at', 'desc')
            ->first();

        if ($lesson === null) {
            return null;
        }

        return $this->formatLesson($lesson);
    }

    protected function formatLesson(Lesson $lesson) : array
    {
        /** @var Course $course */
        $course = Course::find($lesson->pivot->course_id);

        $url = $lesson->learnUrl($course);

        if ($lesson->pivot->finished_at !== null && $course !== null) {
            $url = $course->next();
        }

        return [
            'lesson' => $lesson->title,
            'course' => $course->title ?? null,
            'url'    => $url,
        ];
    }
}