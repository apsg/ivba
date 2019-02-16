<?php

namespace App;

use App\Interfaces\OrderableContract;
use App\Traits\ChecksSlugs;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model implements OrderableContract
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
        "video_id",
        "user_id",
        "introduction",
        "duration",
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
     * Obrazek - okładka
     * @return [type] [description]
     */
    public function image()
    {
        return $this->belongsTo(\App\Image::class);
    }

    /**
     * Główny film
     * @return [type] [description]
     */
    public function video()
    {
        return $this->belongsTo(\App\Video::class);
    }

    /**
     * Kto utworzył lekcję
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Lista kursów, do których przypisano tę lekcję
     * @return [type] [description]
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot('position');
    }

    /**
     * Lista elementów-obrazów dodanych do tej lekcji
     * @return [type] [description]
     */
    public function images()
    {
        return $this->morphedByMany(\App\ItemImage::class, 'items')->withPivot('position');
    }

    /**
     * Lista elementów-tekstów dodanych do lekcji
     * @return [type] [description]
     */
    public function texts()
    {
        return $this->morphedByMany(\App\ItemText::class, 'items')->withPivot('position');
    }

    /**
     * Lista elementów-plików dodanych do lekcji
     * @return [type] [description]
     */
    public function files()
    {
        return $this->morphedByMany(\App\ItemFile::class, 'items')->withPivot('position');
    }

    /**
     * Lista elementów-filmów dodanych do lekcji
     * @return [type] [description]
     */
    public function videos()
    {
        return $this->morphedByMany(\App\ItemMovie::class, 'items')->withPivot('position');
    }

    /**
     * Lista użytkowników, którzy zapisali się na tę lekcję.
     * @return [type] [description]
     */
    public function users()
    {
        return $this->belongsToMany(\App\User::class);
    }

    /**
     * Zwraca wszystkie elementy przypisane do tej lekcji
     * @return [type] [description]
     */
    public function items()
    {
        $itemsDB = DB::table('items')
            ->where('lesson_id', $this->id)
            ->orderBy('position', 'asc')
            ->get();

        $items = [];
        foreach ($itemsDB as $idb) {
            $items[] = call_user_func("\\" . $idb->items_type . "::findOrFail", $idb->items_id);
            end($items)->position = $idb->position;
        }

        return $items;
    }

    /**
     * Jaki będzie kolejny numer pozycji elementu dodanego do tej lekcji?
     * @return integer [pozycja]
     */
    public function nextItemPosition()
    {
        return DB::table('items')
                ->where('lesson_id', $this->id)
                ->select(DB::raw('MAX(position) as position'))
                ->first()->position + 1;
    }

    /**
     * Lista lekcji oprócz lekcji już przypisanych do kursu o danym ID
     * @param  [type] $query [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public function scopeExcept($query, $id)
    {
        $exceptIds = DB::table('course_lesson')
            ->where('course_id', $id)
            ->select('lesson_id')
            ->get()->pluck('lesson_id')->all();

        return $query->whereNotIn('id', $exceptIds);
    }

    /**
     * Czy dany użytkownik ma dostęp do tej lekcji poprzez jakiś kurs?
     * @param  [type]  $user_id [description]
     * @return boolean          [description]
     */
    public function hasCourseAccess($user_id)
    {
        foreach ($this->courses as $course) {
            if ($course->hasAccess($user_id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Nie ma innej opcji dostępu do pojedynczej lekcji, niż poprzez kurs
     * @param  [type]  $user_id [description]
     * @return boolean          [description]
     */
    public function hasAccess($user_id)
    {
        return $this->hasCourseAccess($user_id);
    }

    /**
     * Link podglądu lekcji
     */
    public function previewLink()
    {
        return url('/lesson/' . $this->slug);
    }

    /**
     * Wygeneruj link do nauki tej lekcji
     */
    public function url(Course $course = null)
    {
        if (is_null($course)) {
            return url('/learn/lesson/' . $this->slug);
        }

        return url('/learn/course/' . $course->slug . '/lesson/' . $this->slug);
    }

    /**
     * Alias
     */
    public function learnUrl(Course $course = null)
    {
        return $this->url($course);
    }

    /**
     * Link zakończenia lekcji
     */
    public function finishUrl(Course $course = null)
    {
        return $this->url($course) . '/finish';
    }

    /**
     * Link zakupu lekcji (dodania do koszyka)
     */
    public function buyUrl()
    {
        return url('/lesson/' . $this->slug . '/buy');
    }

    /**
     * Uzytkownik ukończył lekcję.
     */
    public function finish(int $courseId = null)
    {
        $this->users()
            ->updateExistingPivot(
                Auth::user()->id,
                array_filter([
                    'finished_at' => Carbon::now(),
                    'course_id'   => $courseId,
                ])
            );
    }

    /**
     * Nazwa do wyświetlania w koszyku
     * @return [type] [description]
     */
    public function cartName()
    {
        return "Lekcja #" . $this->id . " - " . $this->title;
    }

    /**
     * Link usuwania z koszyka
     * @return [type] [description]
     */
    public function removeLink(Order $order)
    {
        return url('/order/' . $order->id . '/lesson/' . $this->id . '/remove');
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

}
