<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Answer.
 *
 * @property int           $id
 * @property int           $user_id
 * @property int           $question_id
 * @property array         $answer
 * @property int           $is_correct
 * @property int           $points
 * @property Carbon|null   $created_at
 * @property Carbon|null   $updated_at
 * @property-read Question $question
 * @property-read User     $user
 *
 * @mixin \Eloquent
 */
class Answer extends Model
{
    protected $fillable = [
        'user_id',
        'question_id',
        'answer',
        'is_correct',
        'points',
    ];

    protected $casts = [
        'answer' => 'array',
    ];

    /**
     * Użytkownik, do którego należy ta odpowiedź.
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Na jakie pytanie to jest odpowiedź?
     * @return [type] [description]
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
