<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Rating.
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Course $course
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereUserId($value)
 * @mixin \Eloquent
 */
class Rating extends Model
{
    protected $guarded = [];

    /**
     * Użytkownik, który dodał ocenę.
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Kurs, do którego dodano ocenę.
     * @return [type] [description]
     */
    public function course()
    {
        return $this->belongsTo(\App\Course::class);
    }
}
