<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionOption
 * @package App
 *
 * @property bool          is_correct
 * @property-read Question question
 *
 * @method Builder|QuestionOption correct()
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
