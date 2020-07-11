<?php
namespace App\Transformers;

use App\Lesson;
use League\Fractal\TransformerAbstract;

class FrontpageLessonTransformer extends TransformerAbstract
{
    public function transform(Lesson $lesson)
    {
        return [
            'title' => $lesson->title,
            'image' => $lesson->image->thumb(400, 300),
            'url'   => $lesson->url(),
        ];
    }
}
