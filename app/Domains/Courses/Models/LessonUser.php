<?php
namespace App\Domains\Courses\Models;

use App\Course;
use App\Lesson;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int         lesson_id
 * @property int         user_id
 * @property Carbon      created_at
 * @property Carbon|null finished_at
 *
 * @property-read Lesson lesson
 *
 * @method static Builder forUserAndCourse(User $user, Course $course)
 */
class LessonUser extends Pivot
{
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function scopeForUserAndCourse(Builder $builder, User $user, Course $course) : Builder
    {
        $lessonIds = $course->lessons->pluck('id');

        return $builder->where('user_id', $user->id)
            ->whereIn('lesson_id', $lessonIds);
    }
}
