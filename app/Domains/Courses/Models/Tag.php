<?php
namespace App\Domains\Courses\Models;

use App\Course;
use App\Helpers\ColorHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

/**
 * @property int           id
 * @property string        name
 * @property string        color
 * @property boolean       is_hidden
 * @property Carbon        created_at
 * @property Carbon        updated_at
 *
 * @property-read Course[] courses
 * @property-read string   text_color
 */
class Tag extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_tag', 'tag_id', 'course_id');
    }

    public function getTextColorAttribute(): string
    {
        return Cache::remember('text_color_' . $this->color, 60*24*365, function () {
            return ColorHelper::getContrastColor($this->color);
        });
    }
}
