<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionOption.
 *
 * @property int           $id
 * @property int           $question_id
 * @property bool          is_correct
 * @property string        $title
 * @property-read Question question
 * @property Carbon|null   $created_at
 * @property Carbon|null   $updated_at
 *
 * @method Builder|QuestionOption correct()
 *
 * @method static Builder|QuestionOption newModelQuery()
 * @method static Builder|QuestionOption newQuery()
 * @method static Builder|QuestionOption query()
 * @method static Builder|QuestionOption whereCreatedAt($value)
 * @method static Builder|QuestionOption whereId($value)
 * @method static Builder|QuestionOption whereIsCorrect($value)
 * @method static Builder|QuestionOption whereQuestionId($value)
 * @method static Builder|QuestionOption whereTitle($value)
 * @method static Builder|QuestionOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuestionOption extends Model
{
    protected $fillable = [
        'question_id',
        'is_correct',
        'title',
    ];

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
