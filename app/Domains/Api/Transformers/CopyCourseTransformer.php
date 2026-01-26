<?php
namespace App\Domains\Api\Transformers;

use App\Course;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class CopyCourseTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [
        'lessons',
        'video',
    ];

    public function transform(Course $course): array
    {
        return $course->toArray() + [
                'image_url' => $course->image !== null ? $course->image->url : null,
            ];
    }

    public function includeLessons(Course $course): Collection
    {
        return $this->collection(
            $course->lessons,
            new CopyLessonTransformer()
        );
    }

    public function includeVideo(Course $course): Item
    {
        return $this->item($course->video, new GenericModelTransformer());
    }
}
