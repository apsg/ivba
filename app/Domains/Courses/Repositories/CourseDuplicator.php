<?php
namespace App\Domains\Courses\Repositories;

use App\Certificate;
use App\Course;
use App\Quiz;
use Illuminate\Support\Str;

class CourseDuplicator
{
    /** @var Course */
    protected $originalCourse;

    /** @var Course */
    protected $duplicatedCourse;

    public function __construct(Course $course)
    {
        $this->originalCourse = $course;
        $this->duplicatedCourse = $this->clone($course);
    }

    protected function clone(Course $course) : Course
    {
        $attributes = $course->getAttributes();
        $attributes['title'] = $attributes['title'] . ' - kopia';
        $attributes['slug'] = $attributes['slug'] . '_klon_' . Str::random(4);

        return Course::create($attributes);
    }

    public function reattachLessons() : self
    {
        foreach ($this->originalCourse->lessons as $lesson) {
            $this->duplicatedCourse->lessons()->attach($lesson->id, [
                'position' => $lesson->pivot->position,
                'delay'    => $lesson->pivot->delay,
            ]);
        }

        return $this;
    }

    public function duplicateCertificate() : self
    {
        if ($this->originalCourse->certificate !== null) {
            Certificate::create([
                'course_id' => $this->duplicatedCourse->id,
                'title'     => $this->originalCourse->certificate->title,
            ]);
        }

        return $this;
    }

    public function duplicateQuizzes() : self
    {
        foreach ($this->originalCourse->quizzes as $quiz) {
            $this->duplicateQuiz($quiz);
        }

        return $this;
    }

    public function get() : Course
    {
        return $this->duplicatedCourse;
    }

    protected function duplicateQuiz(Quiz $quiz)
    {
        (new QuizDuplicator($quiz, $this->duplicatedCourse))->duplicate();
    }
}
