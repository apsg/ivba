<?php
namespace App\Domains\Logbooks;

use App\Course;
use App\Domains\Courses\Models\CourseUser;
use App\Domains\Courses\Models\LessonUser;
use App\Domains\Logbooks\Models\LogbookEntry;
use App\User;
use Illuminate\Support\Collection;

class CourseActivityService
{
    public function get(User $user, Course $course) : array
    {
        $entries = $this->getEntries($user, $course);
        $pivot = CourseUser::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();
        $logbooks = $course->logbooks;
        $lessons = LessonUser::forUserAndCourse($user, $course)->with('lesson')->get();

        return compact('entries', 'pivot', 'logbooks', 'lessons');
    }

    protected function getEntries(User $user, Course $course) : Collection
    {
        return LogbookEntry::forUserAndCourse($user, $course)
            ->with('comments')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
