<?php
namespace Tests\Concerns;

use App\Certificate;
use App\Course;
use App\Lesson;

trait CourseConcerns
{
    public function createCourse(int $lessons = 0) : Course
    {
        $course = factory(Course::class)->create();

        for ($i = 0; $i < $lessons; $i++) {
            $this->attachLesson($course);
        }

        return $course->fresh()->load('lessons');
    }

    protected function attachLesson(Course $course) : Lesson
    {
        $lesson = factory(Lesson::class)->create();

        $course->lessons()->attach($lesson->id);

        return $lesson;
    }

    protected function attachCertificate(Course $course) : Certificate
    {
        return factory(Certificate::class)->create([
            'course_id' => $course->id,
        ]);
    }

    public function createSpecialCourse(int $lessons = 0) : Course
    {
        $course = $this->createCourse($lessons);
        $course->update([
            'is_special_access' => true,
        ]);

        return $course;
    }
}
