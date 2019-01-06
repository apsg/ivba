<?php
namespace App\Transformers;

use App\Course;
use League\Fractal\TransformerAbstract;

class CoursesTransformer extends TransformerAbstract
{
    /** @var int|null */
    protected $currentDay = null;

    public function __construct($currentDay = null)
    {
        $this->currentDay = $currentDay;
    }

    public function transform(Course $course)
    {
        if ($this->currentDay === null || $course->cumulative_delay <= $this->currentDay) {
            return [
                'title'   => $this->conv($course->title),
                'excerpt' => $this->conv($course->excerpt),
                'img'     => $course->image->thumb(600, 300),
                'url'     => $course->link(),
                'wait'    => 0,
            ];
        }

        return [
            'title'   => $this->conv($course->title),
            'excerpt' => $this->conv($course->excerpt),
            'img'     => $course->image->thumb(600, 300),
            'url'     => null,
            'wait'    => $course->cumulative_delay - $this->currentDay,
        ];
    }

    protected function conv(string $text) : string
    {
        return mb_convert_encoding($text, 'UTF-8');
    }
}