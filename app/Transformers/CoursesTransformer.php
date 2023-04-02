<?php
namespace App\Transformers;

use App\Course;
use App\User;
use League\Fractal\TransformerAbstract;

class CoursesTransformer extends TransformerAbstract
{
    /** @var int|null */
    protected $currentDay = null;
    protected ?User $user = null;

    public function __construct($currentDay = null, User $user = null)
    {
        $this->currentDay = $currentDay;
        $this->user = $user;
    }

    public function transform(Course $course)
    {
        if ($this->currentDay === null || $course->cumulative_delay <= $this->currentDay) {
            return [
                'title'    => $this->convert($course->title),
                'excerpt'  => $this->convert($course->excerpt),
                'img'      => $course->image ? $course->image->thumb(600, 300) : null,
                'url'      => $course->link(),
                'wait'     => 0,
                'finished' => $this->isFinished($course),
            ];
        }

        return [
            'title'   => $this->convert($course->title),
            'excerpt' => $this->convert($course->excerpt),
            'img'     => $course->image ? $course->image->thumb(600, 300) : null,
            'url'     => null,
            'wait'    => $course->cumulative_delay - $this->currentDay,
        ];
    }

    protected function convert(string $text): string
    {
        return mb_convert_encoding($text, 'UTF-8');
    }

    protected function isFinished(Course $course): bool
    {
        if ($this->user === null) {
            return false;
        }

        return $this->user->hasFinishedCourse($course->id);
    }
}
