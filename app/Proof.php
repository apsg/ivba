<?php
namespace App;

use App\Helpers\CityFromIp;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proof
 *
 * @package App
 * @property string      name
 * @property string|null city
 * @property string      body
 * @property bool        is_registered
 * @property string      url
 * @property int         user_id
 * @property Carbon      created_at
 * @property Carbon      updated_at
 * @property int $id
 * @property string $name
 * @property string|null $city
 * @property string|null $url
 * @property string $body
 * @property int $is_registered
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereIsRegistered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereUserId($value)
 * @mixin \Eloquent
 */
class Proof extends Model
{
    protected $fillable = ['name', 'city', 'body', 'is_registered', 'url', 'user_id'];

    /**
     * Tworzy nowy proof typu "ktoś się zarejestrował"
     */
    public static function createRegistered(User $user)
    {
        return static::create([
            'name'          => static::getName($user),
            'city'          => CityFromIp::get(request()->ip()),
            'url'           => url('/register'),
            'body'          => "Zarejestrował/a się.",
            'user_id'       => $user->id,
            'is_registered' => false,
        ]);
    }

    /**
     * Tworzy nowy proof typu "ukończono lekcję"
     */
    public static function createFinishedLesson(User $user, Lesson $lesson)
    {
        return static::create([
            'name'          => static::getName($user),
            'city'          => CityFromIp::get(request()->ip()),
            'url'           => $lesson->previewLink(),
            'body'          => "Ukończył/a lekcję: " . $lesson->title,
            'user_id'       => $user->id,
            'is_registered' => true,
        ]);
    }

    /**
     * Tworzy nowy proof typu "ukończono lekcję"
     */
    public static function createFinishedCourse(User $user, Course $course)
    {
        return static::create([
            'name'          => static::getName($user),
            'city'          => CityFromIp::get(request()->ip()),
            'url'           => $course->link(),
            'body'          => "Ukończył/a kurs: " . $course->title,
            'user_id'       => $user->id,
            'is_registered' => true,
        ]);
    }

    /**
     * Tworzy nowy proof typu "ukończono lekcję"
     */
    public static function createFinishedQuiz(User $user, Quiz $quiz)
    {
        return static::create([
            'name'          => static::getName($user),
            'city'          => CityFromIp::get(request()->ip()),
            'url'           => $quiz->course->link(),
            'body'          => "Ukończył/a test: " . $quiz->name,
            'user_id'       => $user->id,
            'is_registered' => true,
        ]);
    }

    /**
     * Zwraca samo imię (pierwszy człon nazwy użytkownika)
     */
    protected static function getName($user)
    {
        return explode(' ', $user->name)[0];
    }

    /**
     * Następny proof dla zarejestrowanego użytkownika
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public static function getNextForUser($user)
    {
        $proof = static::where('user_id', '!=', $user->id)
            ->where('id', '>', $user->last_proof_id ?? 0)
            ->where('is_registered', true)
            ->orderBy('id', 'asc')
            ->first();

        if ($proof) {
            $user->update([
                'last_proof_id' => $proof->id,
                'last_proof_at' => Carbon::now(),
            ]);
        }

        return $proof;
    }

    /**
     * Następny proof dla niezarejestrowanego
     * @param  [type] $last_proof_id [description]
     * @return [type]                [description]
     */
    public static function getNextUnregistered($last_proof_id)
    {
        return $proof = static::where('is_registered', false)
            ->where('id', '>', $last_proof_id)
            ->orderBy('id', 'asc')
            ->first();
    }

}
