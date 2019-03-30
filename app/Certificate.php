<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Certificate
 *
 * @property int $id
 * @property int $course_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Certificate extends Model
{
    protected $guarded = [];

    /**
     * Kurs, do którego przypisano ten certyfikat.
     * @return [type] [description]
     */
    public function course(){
    	return $this->belongsTo(\App\Course::class);
    }
    
}
