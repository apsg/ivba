<?php
namespace App\Domains\Forms\Models;

use App\Course;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int                          id
 * @property int                          course_id
 * @property string                       type
 * @property Carbon                       created_at
 * @property Carbon                       updated_at
 *
 * @property-read Course                  course
 * @property-read Collection|FormAnswer[] answers
 *
 * @property-read array                   fields
 * @property-read string                  name
 */
class Form extends Model
{
    protected $fillable = [
        'course_id',
        'type',
    ];

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function answers() : HasMany
    {
        return $this->hasMany(FormAnswer::class);
    }

    public function getFieldsAttribute()
    {
        return config("forms.{$this->type}.fields");
    }

    public function getNameAttribute() : string
    {
        return config("forms.{$this->type}.name");
    }

    public function textForKey(string $key) : string
    {
        return config("forms.{$this->type}.fields.{$key}.name", '');
    }
}
