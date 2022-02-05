<?php

namespace App;

use App\Events\UserHasPassedQuizEvent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Quiz.
 *
 * @property int                        $id
 * @property int                        $course_id
 * @property string                     $name
 * @property int                        $is_certified
 * @property int                        $is_random
 * @property int                        $pass_threshold
 * @property Carbon|null                $created_at
 * @property Carbon|null                $updated_at
 * @property-read Course                $course
 * @property-read mixed                 $max_points
 * @property-read Collection|Question[] $questions
 * @property-read Collection|User[]     $users
 * @method static Builder|Quiz newModelQuery()
 * @method static Builder|Quiz newQuery()
 * @method static Builder|Quiz query()
 * @method static Builder|Quiz whereCourseId($value)
 * @method static Builder|Quiz whereCreatedAt($value)
 * @method static Builder|Quiz whereId($value)
 * @method static Builder|Quiz whereIsCertified($value)
 * @method static Builder|Quiz whereIsRandom($value)
 * @method static Builder|Quiz whereName($value)
 * @method static Builder|Quiz wherePassThreshold($value)
 * @method static Builder|Quiz whereUpdatedAt($value)
 */
class Quiz extends Model
{
    const RETAKE_QUIZ_IN_DAYS = 14;

    protected $fillable = [
        'course_id',
        'name',
        'is_certified',
        'is_random',
        'pass_threshold',
    ];

    /**
     * Kurs, do którego ten test jest przypisany.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Pytania przypisane do tego testu.
     */
    public function questions()
    {
        return $this->hasMany(Question::class)
            ->orderBy('position');
    }

    /**
     * Użytkownicy, którzy wzięli udział w tym teście.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('finished_date', 'points', 'is_pass');
    }

    /**
     * Zwraca link do tego quizu.
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
     * Link rozpoczynania quizu.
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
     * Zakończ kurs.
     */
    public function finish() : self
    {
        $question_ids = $this->questions->pluck('id');

        /** @var User $user */
        $user = Auth::user();

        if (!$user->hasStartedQuiz($this->id)) {
            $this->users()->save($user);
        }

        $points = Answer::where('user_id', $user->id)
            ->whereIn('question_id', $question_ids)
            ->sum('points');

        $percentage = $this->max_points != 0 ? 100 * $points / $this->max_points : 1;

        $isPass = $percentage >= $this->pass_threshold;

        if ($isPass && !$user->hasPassedQuiz($this->id)) {
            event(new UserHasPassedQuizEvent($user, $this));
        }

        $this->users()->updateExistingPivot($user->id, [
            'points'        => $points,
            'finished_date' => Carbon::now(),
            'is_pass'       => $isPass,
        ]);

        return $this;
    }

    /**
     * zwraca maksymalną liczbę punktów za ten test.
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
