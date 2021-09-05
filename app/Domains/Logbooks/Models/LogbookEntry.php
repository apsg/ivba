<?php
namespace App\Domains\Logbooks\Models;

use App\Course;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property int          id
 * @property int          user_id
 * @property int          logbook_id
 * @property int          course_id
 * @property string       title
 * @property string       description
 * @property string|null  image
 * @property Carbon       created_at
 * @property Carbon       updated_at
 *
 * @property-read User    $user
 * @property-read Logbook $logbook
 * @property-read Course  $course
 *
 * @property-read string  image_url
 *
 * @method static Builder forUserAndCourse(User $user, Course $course)
 */
class LogbookEntry extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'logbook_id',
        'title',
        'description',
        'image',
    ];

    protected $appends = [
        'image_url',
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

    public function hasImage() : bool
    {
        return !empty($this->image);
    }

    public function imageUrl() : string
    {
        if (empty($this->image)) {
            return '';
        }
        
        return url(Storage::url($this->image));
    }

    public function getImageUrlAttribute() : string
    {
        return $this->imageUrl();
    }

    public function scopeForUserAndCourse(Builder $query, User $user, Course $course)
    {
        return $query
            ->where('user_id', $user->id)
            ->where('course_id', $course->id);
    }
}
