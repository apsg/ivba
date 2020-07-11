<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Certificate.
 *
 * @property int         $id
 * @property int         $course_id
 * @property string      $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Course $course
 * @method static Builder|Certificate newModelQuery()
 * @method static Builder|Certificate newQuery()
 * @method static Builder|Certificate query()
 * @method static Builder|Certificate whereCourseId($value)
 * @method static Builder|Certificate whereCreatedAt($value)
 * @method static Builder|Certificate whereId($value)
 * @method static Builder|Certificate whereTitle($value)
 * @method static Builder|Certificate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Certificate extends Model
{
    protected $guarded = [];

    /**
     * Kurs, do którego przypisano ten certyfikat.
     * @return [type] [description]
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
