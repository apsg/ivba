<?php
namespace Tests\Concerns;

use App\Course;

trait CourseConcerns
{
    public function creteCourse() : Course
    {
        return factory(Course::class)->create();
    }

}