<?php
namespace App\Domains\Courses\Models;

use App\Course;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int                     id
 * @property string                  name
 * @property int|null                order
 * @property Carbon                  created_at
 * @property Carbon                  updated_at
 *
 * @property-read Collection<Course> courses
 *
 * @mixin Eloquent
 */
class Group extends Model
{
    protected $guarded = [];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
