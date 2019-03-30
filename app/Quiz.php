<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Quiz
 *
 * @property int $id
 * @property int $course_id
 * @property string $name
 * @property int $is_certified
 * @property int $is_random
 * @property int $pass_threshold
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Course $course
 * @property-read mixed $max_points
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereIsCertified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereIsRandom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz wherePassThreshold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Quiz extends Model
{
    protected $guarded = [];

    /**
     * Kurs, do którego ten test jest przypisany
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Pytania przypisane do tego testu
     */
    public function questions()
    {
        return $this->hasMany(Question::class)
            ->orderBy('position');
    }

    /**
     * Użytkownicy, którzy wzięli udział w tym teście
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('finished_date', 'points', 'is_pass');
    }

    /**
     * Zwraca link do tego quizu
     */
    public function url()
    {
        return url('/learn/course/' . $this->course->slug . '/quiz/' . $this->id);
    }

    // Alias
    public function learnUrl()
    {
        return $this->url();
    }

    /**
     * Link rozpoczynania quizu
     */
    public function startUrl()
    {
        return url('/learn/course/' . $this->course->slug . '/quiz/' . $this->id . '/start');
    }

    public function resetLink()
    {
        return url('/learn/course/' . $this->course->slug . '/quiz/' . $this->id . '/reset');
    }

    /**
     * Zwraca następne pytanie dla tego użytkownika (lub null, jeśli
     * odpowiedział już na wszystkie pytania).
     */
    public function nextQuestion(User $user)
    {
        $ids = $user->answers->pluck('question_id');

        if ($this->is_random) {
            return $this->questions()
                ->whereNotIn('id', $ids)
                ->inRandomOrder()
                ->first();
        } else {
            return $this->questions()
                ->whereNotIn('id', $ids)
                ->orderBy('position', 'asc')
                ->first();
        }
    }

    /**
     * Zakończ kurs
     */
    public function finish() : self
    {
        $question_ids = $this->questions->pluck('id');


        $points = Answer::where('user_id', Auth::user()->id)
            ->whereIn('question_id', $question_ids)
            ->sum('points');

        $percentage = 100 * $points / $this->max_points;

        $this->users()->updateExistingPivot(Auth::user()->id, [
            'points'        => $points,
            'finished_date' => Carbon::now(),
            'is_pass'       => $percentage >= $this->pass_threshold,
        ]);

        return $this;
    }

    /**
     * zwraca maksymalną liczbę punktów za ten test
     */
    public function getMaxPointsAttribute() : int
    {
        return $this->questions()->sum('points');
    }

    public function userScore(User $user)
    {
        return $this->users()
                ->where('user_id', $user->id)
                ->first()
                ->pivot
                ->points ?? 0;
    }

}
