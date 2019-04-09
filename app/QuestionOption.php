<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionOption
 *
 * @package App
 * @property bool                            is_correct
 * @property-read Question                   question
 * @method Builder|QuestionOption correct()
 * @property int                             $id
 * @property int                             $question_id
 * @property string                          $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereIsCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuestionOption extends Model
{
    protected $guarded = [];

    /**
     * Do którego pytania należy ta odpowiedź.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }


    public function scopeCorrect(Builder $query)
    {
        return $query->where('is_correct', '=', true);
    }
}
