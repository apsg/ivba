<?php
namespace App\Domains\Courses\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int    course_id
 * @property int    user_id
 * @property Carbon finished_at
 * @property Carbon created_at
 */
class CourseUser extends Pivot
{

}
