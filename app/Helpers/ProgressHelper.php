<?php
namespace App\Helpers;

use App\Course;
use App\User;

class ProgressHelper
{
    public static function cacheKey(User $user = null, Course $course = null)
    {
        return static::cacheKeyById($user->id ?? 0, $course->id ?? 0);
    }

    public static function cacheKeyById(int $userId, int $courseId)
    {
        return 'progress-' . $userId . '-' . $courseId;
    }
}