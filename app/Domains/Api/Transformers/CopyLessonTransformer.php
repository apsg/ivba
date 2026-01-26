<?php
namespace App\Domains\Api\Transformers;

use App\Lesson;
use League\Fractal\TransformerAbstract;

class CopyLessonTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['video', 'items'];

    public function transform(Lesson $lesson): array
    {
        return $lesson->toArray();
    }

    public function includeVideo(Lesson $lesson)
    {
        if (!$lesson->video) {
            return null;
        }

        return $lesson->video->toArray();
    }

    public function includeItems(Lesson $lesson)
    {
        return $this->collection($lesson->items(), new ItemTransformer());
    }
}
