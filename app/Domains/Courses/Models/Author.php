<?php
namespace App\Domains\Courses\Models;

use App\Course;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int           id
 * @property string        name
 * @property string|null   description
 * @property string|null   image
 * @property boolean       is_internal
 * @property Carbon        created_at
 * @property Carbon        updated_at
 *
 * @property-read Course[] courses
 */
class Author extends Model
{
    protected $guarded = [];
    protected $casts = [
        'is_internal' => 'boolean',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
