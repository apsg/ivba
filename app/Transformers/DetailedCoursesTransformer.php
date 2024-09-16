<?php
namespace App\Transformers;

use App\Course;
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;

class DetailedCoursesTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['tags'];
    protected array $availableIncludes = ['tags'];

    public function transform(Course $course): array
    {
        return [
            'id'           => $course->id,
            'title'        => $course->title,
            'description'  => Str::words(strip_tags($course->description), 20),
            'price'        => $course->price,
            'price_full'   => $course->price_full,
            'payment_link' => $course->payment_link,
            'lesson_count' => $course->lessons->count(),
            'duration'     => $course->duration,
            'rating'       => $course->avg_rating,
            'image'        => $course->image ? $course->image->thumb(600, 300) : null,
            'topics'       => $course->topics ?? '',
            'author'       => $course->author->name ?? '',
            'is_internal'  => $course->author->is_internal ?? false,
        ];
    }

    public function includeTags(Course $course)
    {
        return $this->collection($course->tags, new TagTransformer());
    }
}
