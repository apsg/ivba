<?php

namespace App;

use App\Access;
use App\Certificate;
use App\Image;
use App\Lesson;
use App\Quiz;
use App\Rating;
use App\Traits\Accessable;
use App\Traits\ChecksSlugs;
use App\Interfaces\OrderableContract;
use App\User;
use App\UserCertificate;
use App\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model implements OrderableContract
{
    use ChecksSlugs;

    public static $SUBSCRIPTION_LENGTH = 31;

    protected $fillable = [
        "title",
        "description",
        "seo_title",
        "seo_description",
        "price",
        "difficulty",
        "slug",
        "image_id",
        "user_id",
        "video_id",
        "position",
        "delay",
    ];

    protected $with = ['image'];

    /**
     * Po czym przeszukujemy ścieżki
     * @return [type] [description]
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Obraz przypisany do tego kursu jako okładka
     * @return [type] [description]
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * Film okładkowy przypisany do tego kursu
     * @return [type] [description]
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    /* alias */
    public function movie()
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * Kto utworzył dany kurs?
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Użytkownicy, którzy zapisali się na ten kurs
     * @return [type] [description]
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Lista lekcji przypisanych do tego kursu
     * @return [type] [description]
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)
            ->withPivot('position')
            ->orderBy('position', 'asc');
    }

    /**
     * Oceny wystawione dla tego kursu
     * @return [type] [description]
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Testy przypisane do tego kursu.
     * @return [type] [description]
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Certyfikat przypisany do tego kursu
     * @return [type] [description]
     */
    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    /**
     * Certyfikaty użytkowników, dla tego kursu
     * @return [type] [description]
     */
    public function user_certificates()
    {
        return $this->hasMany(UserCertificate::class);
    }


    /**
     * Lista wszystkich dostępów dla tego elementu
     * @return [type] [description]
     */
    public function access()
    {
        return $this->morphMany(Access::class, 'accessable');
    }

    /**
     * Sprawdź, czy dany użytkownik ma dostęp do tego elementu
     * @param  integer $user_id [id użytkownika]
     * @return boolean          [description]
     */
    public function hasAccess($user_id)
    {

        $user = User::findOrFail($user_id);


        // Użytkownik ma pełen dostęp do wszystkiego - nic innego nas nie obchodzi
        if ($user->hasFullAccess()) {
            return true;
        }

        if (!$user->hasDayAccess()) {
            return false;
        }

        // Czy liczba wykupionych dni jest większa, niż opóźnienie kursu
        return $this->cumulative_delay <= $user->current_day;
    }

    /**
     * Zwraca certyfikat aktualnie zalogowanego użytkownika
     * @return [type] [description]
     */
    public function getUserCertificateAttribute()
    {
        if (Auth::check()) {
            return $this->user_certificates()
                ->where('user_id', Auth::user()->id)
                ->first();
        }

        return null;
    }


    /**
     * Zwraca skrót opisu kursu
     * @return [type] [description]
     */
    public function getExcerptAttribute()
    {
        return substr(strip_tags($this->description), 0, 120) . '...';
    }

    /**
     * Czas trwania w minutach
     * @return [type] [description]
     */
    public function getDurationAttribute()
    {
        return $this->lessons->sum('duration');
    }

    /**
     * Czas trwania (sformatowany)
     * @return [type] [description]
     */
    public function duration()
    {
        $h = floor($this->duration / 60);
        $m = $this->duration - $h * 60;

        return $h > 0 ? "{$h}h {$m} min." : "{$m} min.";
    }

    /**
     * Link do tego kursu
     * @return [type] [description]
     */
    public function link()
    {
        return url('/course/' . $this->slug);
    }

    /**
     * Link do rozpoczęcia nauki tego kursu
     * @return [type] [description]
     */
    public function learnUrl()
    {
        return url('/learn/course/' . $this->slug);
    }

    /**
     * Link do ekranu zakończenia kursu
     * @return [type] [description]
     */
    public function finishedUrl()
    {
        return url('/learn/course/' . $this->slug . '/finished');
    }

    /**
     * Zwraca sformatowany tekst stopnia trudności
     * @return [type] [description]
     */
    public function difficulty()
    {
        switch ($this->difficulty) {
            case 1 :
                return "Łatwa";
            case 2 :
                return "Średnia";
            case 3 :
                return "Trudna";
        }
    }

    /**
     * [nextLessonLink description]
     * @param  [type] $lesson_id [description]
     * @return [type]            [description]
     */
    public function nextLessonLink($lesson_id = null)
    {
        if (empty($lesson_id)) {
            return $this->learnUrl();
        }

        $order = $this->lessons()
            ->where('lesson_id', $lesson_id)
            ->pluck('position')
            ->first();

        $next = $this->lessons()->where('position', $order + 1)->first();

        if (is_null($next)) {
            $lesson_ids = $this->lessons()->pluck('lesson_id')->all();

            $next = \Auth::user()
                ->lessons()
                ->whereIn('lesson_id', $lesson_ids)
                ->whereNull('finished_at')
                ->first();
        }

        if (is_null($next)) {
            return $this->next();
        }

        return $next->url($this);
    }

    /**
     * Zwraca link do następnego nieukończonego elementu w tym kursie
     * @param  [type]   $lesson_id [description]
     * @return function            [description]
     */
    public function next()
    {

        $user = \Auth::user();

        // Czy została jakaś lekcja do ukończenia?
        foreach ($this->lessons as $lesson) {
            if (!$user->hasFinishedLesson($lesson->id)) {
                return $lesson->learnUrl($this);
            }
        }

        // Czy został jakiś test do ukończenia?
        foreach ($this->quizzes as $quiz) {
            if (!$user->hasFinishedQuiz($quiz->id)) {
                return $quiz->learnUrl();
            }
        }

        // Doszliśmy tutaj, czyli nie ma nic więcej.
        // Można sprawdzić, czy kurs jest zakończony i zwrócić link.
        if (!$user->hasFinishedCourse($this->id)) {
            $this->finish();
        }

        return $this->finishedUrl();
    }

    /**
     * Użytkownik ukończył ten kurs
     * @return [type] [description]
     */
    public function finish()
    {
        $this->users()
            ->updateExistingPivot(
                \Auth::user()->id,
                ['finished_at' => \Carbon\Carbon::now()]
            );

        if (!empty($this->certificate)) {
            UserCertificate::create([
                'user_id'        => \Auth::user()->id,
                'certificate_id' => $this->certificate->id,
                'course_id'      => $this->id,
            ]);
        }

        \App\Proof::createFinishedCourse(\Auth::user(), $this);
    }

    /**
     * Nazwa do wyświetlania w koszyku
     * @return [type] [description]
     */
    public function cartName()
    {
        return "Kurs #" . $this->id . " - " . $this->title;
    }

    /**
     * Link usuwania z koszyka
     * @return [type] [description]
     */
    public function removeLink(\App\Order $order)
    {
        return url('/order/' . $order->id . '/course/' . $this->id . '/remove');
    }

    /**
     * Zwraca liczbę osób zapisanych na ten kurs
     * @return [type] [description]
     */
    public function getUsersCountAttribute()
    {
        $course_id = $this->id;
        return \Cache::remember('course_users_count_' . $this->id,
            60 * 12,
            function () use ($course_id) {
                return \DB::table('course_user')
                    ->where('course_id', $course_id)
                    ->count();
            }
        );
    }

    /**
     * Zwraca ocenę dla aktualnego użytkownika
     * @return [type] [description]
     */
    public function getRatingAttribute()
    {
        if (\Auth::check()) {
            return Rating::where('user_id', \Auth::user()->id)
                ->where('course_id', $this->id)
                ->first();
        } else {
            return null;
        }
    }

    /**
     * Zwraca średnią wartość ocen dla tego kursu
     * @return [type] [description]
     */
    public function getAvgRatingAttribute()
    {
        return (float)$this->ratings()->avg('rating');
    }

    /**
     * Zwraca liczbę ocen dla tego kursu
     * @return [type] [description]
     */
    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }

    /**
     * Przelicza na nowo cumulative_delay po zmianie kolejności
     * @return [type] [description]
     */
    public static function reorder()
    {

        $courses = static::query()->orderBy('position', 'asc')->get();

        $sum = 0;

        foreach ($courses as $course) {

            $sum = $sum + $course->delay;
            $course->cumulative_delay = $sum;
            $course->save();
        }
    }


    public function getRealDelayAttribute()
    {
        if (Auth::check()) {
            return max(0, $this->cumulative_delay - Auth::user()->current_day);
        }

        return $this->cumulative_delay;
    }
}
