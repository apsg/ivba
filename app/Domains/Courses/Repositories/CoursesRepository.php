<?php
namespace App\Domains\Courses\Repositories;

use App\Course;

class CoursesRepository
{
    public function duplicate(Course $course) : Course
    {
        return (new CourseDuplicator($course))
            ->reattachLessons()
            ->duplicateCertificate()
            ->duplicateQuizzes()
            ->get();
    }
}
