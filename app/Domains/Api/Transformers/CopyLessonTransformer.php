<?php
namespace App\Domains\Api\Transformers;

use App\Lesson;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class CopyLessonTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['video', 'items'];

    public function transform(Lesson $lesson): array
    {
        return $lesson->toArray();
    }

    public function includeVideo(Lesson $lesson): Item
    {
        return $this->item($lesson->video, new GenericModelTransformer());
    }

    public function includeItems(Lesson $lesson): Collection
    {
        return $this->collection($lesson->items(), new GenericModelTransformer());
    }
}
