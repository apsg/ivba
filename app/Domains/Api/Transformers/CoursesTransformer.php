<?php
namespace App\Domains\Api\Transformers;

use App\Course;
use League\Fractal\TransformerAbstract;

class CoursesTransformer extends TransformerAbstract
{
    public function transform(Course $course) : array
    {
        return [
            'id'    => $course->id,
            'title' => $course->title,
        ];
    }
}
