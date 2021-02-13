<?php
namespace App\Domains\Courses\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int position
 * @property int delay
 */
class CourseLesson extends Pivot
{
    protected $fillable = [
        'position',
        'delay',
    ];
}
