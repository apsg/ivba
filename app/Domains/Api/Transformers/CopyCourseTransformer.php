<?php
namespace App\Domains\Api\Transformers;

use App\Course;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class CopyCourseTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [
        'lessons', 'image', 'video',
    ];

    public function transform(Course $course): array
    {
        return $course->toArray();
    }

    public function includeLessons(Course $course): Collection
    {
        return $this->collection(
            $course->lessons,
            new CopyLessonTransformer()
        );
    }

    public function includeImage(Course $course)
    {
        if (!$course->image) {
            return null;
        }

        return $course->image->toArray();
    }
    public function includeVideo(Course $course)
    {
        if (!$course->video) {
            return null;
        }

        return $course->video->toArray();
    }
}
