<?php
namespace App\Domains\Logbooks\Models;

use App\Course;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int          id
 * @property int          user_id
 * @property int          logbook_id
 * @property int          course_id
 * @property string       title
 * @property string       description
 * @property Carbon       created_at
 * @property Carbon       updated_at
 *
 * @property-read User    $user
 * @property-read Logbook $logbook
 * @property-read Course  $course
 *
 */
class LogbookEntry extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'logbook_id',
        'title',
        'description',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logbook() : BelongsTo
    {
        return $this->belongsTo(Logbook::class);
    }

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
