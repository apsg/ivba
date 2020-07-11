<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Question.
 *
 * @property int                                                                 $id
 * @property int                                                                 $quiz_id
 * @property int                                                                 $type
 * @property string                                                              $title
 * @property string                                                              $content
 * @property int                                                                 $points
 * @property int                                                                 $position
 * @property string|null                                                         $answer
 * @property \Illuminate\Support\Carbon|null                                     $created_at
 * @property \Illuminate\Support\Carbon|null                                     $updated_at
 * @property-read \[type] $type_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\QuestionOption[] $options
 * @property-read \App\Quiz                                                      $quiz
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Question extends Model
{
    protected $guarded = [];

    /**
     * Typy pytań, jakie możemy mieć w systemie.
     */
    // Jednokrotny wybór
    const SINGLE = 1;
    // Wielokrotny wybór
    const MULTIPLE = 2;
    // Otwarte
    const OPEN = 3;

    /**
     * Do którego testu należy to pytanie.
     * @return [type] [description]
     */
    public function quiz()
    {
        return $this->belongsTo(\App\Quiz::class);
    }

    /**
     * Odpowiedzi do tego pytania.
     * @return [type] [description]
     */
    public function options()
    {
        return $this->hasMany(\App\QuestionOption::class);
    }

    /**
     * Zwraca nazwę dla poszczególnych typów.
     * @return [type] [description]
     */
    public function getTypeNameAttribute()
    {
        switch ($this->type) {
            case static::SINGLE:
                return 'Jednokrotny wybór';
                break;
            case static::MULTIPLE:
                return 'Wielokrotny wybór';
                break;
            case static::OPEN:
                return 'Pytanie otwarte';
                break;
        }
    }

    /**
     * Sprawdza, czy pytanie jest poprawne.
     * @return bool [description]
     */
    public function isValid() : bool
    {
        if (empty($this->content)) {
            return false;
        }

        switch ($this->type) {
            case static::SINGLE:
            case static::MULTIPLE:
                return $this->options()->where('is_correct', true)->count() > 0;
                break;
            case static::OPEN:
                return ! empty($this->answer);
                break;
            default:
                return false;
        }
    }

    /**
     * Sprawdza, czy podana odpowiedź jest prawidłowa.
     */
    public function check($answer) : bool
    {
        switch ($this->type) {
            case static::SINGLE:
            {
                $answer = (int) $answer;

                $correct = $this->options()
                    ->correct()
                    ->get()->pluck('id')
                    ->toArray();

                return in_array($answer, $correct);
                break;
            }
            case static::MULTIPLE:
            {
                if (! is_array($answer)) {
                    return false;
                }

                $correct = $this->options()
                    ->correct()
                    ->get()->pluck('id')
                    ->toArray();

                return empty(array_diff($correct, $answer));
                break;
            }
            case static::OPEN:
            {
                if (! is_string($answer)) {
                    return false;
                }

                return strtolower($answer) == strtolower($this->answer);
                break;
            }
        }

        return false;
    }

    public function getCorrectAnswer()
    {
        switch ($this->type) {
            case static::SINGLE:
            {
                return $this->options()
                    ->correct()
                    ->get()->pluck('id')
                    ->toArray();
            }
            case static::MULTIPLE:
            {
                return $this->options()
                    ->correct()
                    ->get()->pluck('id')
                    ->toArray();
            }
            case static::OPEN:
                return $this->answer;
        }

        return false;
    }
}
