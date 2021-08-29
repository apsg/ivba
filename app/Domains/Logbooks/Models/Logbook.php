<?php
namespace App\Domains\Logbooks\Models;

use App\Course;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int                      id
 * @property string                   title
 * @property string|null              description
 * @property Carbon                   created_at
 * @property Carbon                   updated_at
 *
 * @property-read Collection|Course[] courses
 */
class Logbook extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function courses() : BelongsToMany
    {
        return $this
            ->belongsToMany(Course::class)
            ->using(CourseLogbookPivot::class);
    }
}
