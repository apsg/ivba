<?php
namespace App\Helpers;

use App\Course;
use App\User;

class ProgressHelper
{
    public static function cacheKey(User $user = null, Course $course = null) : string
    {
        return static::cacheKeyById($user->id ?? 0, $course->id ?? 0);
    }

    public static function cacheKeyById(int $userId = null, int $courseId = null) : string
    {
        return 'progress-' . $userId . '-' . $courseId;
    }
}
