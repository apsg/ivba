<?php
namespace App;

use App\Domains\Courses\Models\CourseLesson;
use App\Domains\Courses\Services\CoursesService;
use App\Domains\Forms\Models\Form;
use App\Domains\Logbooks\Models\CourseLogbookPivot;
use App\Domains\Logbooks\Models\Logbook;
use App\Interfaces\AccessableContract;
use App\Interfaces\OrderableContract;
use App\Repositories\AccessRepository;
use App\Traits\ChecksSlugs;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * App\Course.
 *
 * @property int                               id
 * @property string                            slug
 * @property int                               user_id
 * @property string                            title
 * @property string                            description
 * @property float                             price
 * @property string|null                       seo_title
 * @property string|null                       seo_description
 * @property int|null                          image_id
 * @property int                               difficulty
 * @property Carbon|null                       created_at
 * @property Carbon|null                       updated_at
 * @property int|null                          video_id
 * @property int                               position
 * @property int                               delay Liczba dni
 * @property int                               cumulative_delay
 * @property bool                              is_special_access
 * @property Carbon|null                       scheduled_at
 * @property boolean                           is_systematic
 *
 * @property-read Collection|Access[]          access
 * @property-read Certificate                  certificate
 * @property-read mixed                        avg_rating
 * @property-read mixed                        duration
 * @property-read mixed                        excerpt
 * @property-read mixed                        rating
 * @property-read mixed                        ratings_count
 * @property-read mixed                        real_delay
 * @property-read Certificate                  user_certificate
 * @property-read int                          users_count
 * @property-read Image|null                   image
 * @property-read Collection|Lesson[]          lessons
 * @property-read Video                        movie
 * @property-read Collection|Quiz[]            quizzes
 * @property-read Collection|Rating[]          ratings
 * @property-read User                         user
 * @property-read Collection|UserCertificate[] user_certificates
 * @property-read Collection|User[]            users
 * @property-read Video|null                   video
 * @property-read Collection|Logbook[]         logbooks
 * @property-read Collection|Form[]            forms
 *
 * @method static Builder withoutSpecial()
 * @method static Builder withoutSpecialExcept(array $ids)
 *
 */
class Course extends Model implements OrderableContract, AccessableContract
{
    use ChecksSlugs;

    public static $SUBSCRIPTION_LENGTH = 31;

    protected $fillable = [
        'title',
        'description',
        'seo_title',
        'seo_description',
        'price',
        'difficulty',
        'slug',
        'image_id',
        'user_id',
        'video_id',
        'position',
        'delay',
        'is_special_access',
        'scheduled_at',
        'is_systematic',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    protected $with = ['image'];

    protected $appends = ['label'];

    /**
     * Po czym przeszukujemy ??cie??ki.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Obraz przypisany do tego kursu jako ok??adka.
     * @return [type] [description]
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * Film ok??adkowy przypisany do tego kursu.
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
     * Kto utworzy?? dany kurs?
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * U??ytkownicy, kt??rzy zapisali si?? na ten kurs.
     * @return [type] [description]
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Lista lekcji przypisanych do tego kursu.
     * @return [type] [description]
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)
            ->using(CourseLesson::class)
            ->withPivot(['position', 'delay'])
            ->orderBy('position', 'asc');
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function visibleLessons(User $user = null)
    {
        if ($this->scheduled_at === null && !$this->is_systematic) {
            return $this->lessons();
        }

        if ($this->is_systematic && $user !== null) {
            $startedAt = app(CoursesService::class)->hasStartedCourseAt($user, $this);
            $diff = $startedAt === null ? 0 : $startedAt->diffInDays();
        } else {
            $diff = $this->scheduled_at->diffInDays() ?? 0;
        }

        return $this->lessons()
            ->where('delay', '<=', $diff);
    }

    /**
     * Oceny wystawione dla tego kursu.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Testy przypisane do tego kursu.
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Certyfikat przypisany do tego kursu.
     */
    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    /**
     * Certyfikaty u??ytkownik??w, dla tego kursu.
     */
    public function user_certificates()
    {
        return $this->hasMany(UserCertificate::class);
    }

    /**
     * Lista wszystkich dost??p??w dla tego elementu.
     */
    public function access()
    {
        return $this->morphMany(Access::class, 'accessable');
    }

    public function logbooks()
    {
        return $this
            ->belongsToMany(Logbook::class)
            ->using(CourseLogbookPivot::class);
    }

    /**
     * Sprawd??, czy dany u??ytkownik ma dost??p do tego elementu.
     */
    public function hasAccess(int $user_id): bool
    {
        /** @var User $user */
        $user = User::findOrFail($user_id);

        // U??ytkownik ma pe??en dost??p do wszystkiego - nic innego nas nie obchodzi
        if (!$this->isSpecialAccess() && $user->hasFullAccess()) {
            return true;
        }

        if (app(AccessRepository::class)->has($user, $this)) {
            return true;
        }

        if (!$user->hasDayAccess()) {
            return false;
        }

        // Czy liczba wykupionych dni jest wi??ksza, ni?? op????nienie kursu
        return $this->cumulative_delay <= $user->current_day;
    }

    /**
     * Zwraca certyfikat aktualnie zalogowanego u??ytkownika.
     * @return Certificate|null
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
     * Zwraca skr??t opisu kursu.
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(html_entity_decode(strip_tags($this->description)), 120);
    }

    /**
     * Czas trwania w minutach.
     */
    public function getDurationAttribute(): int
    {
        return $this->lessons->sum('duration');
    }

    /**
     * Czas trwania (sformatowany).
     */
    public function duration(): string
    {
        $h = floor($this->duration / 60);
        $m = $this->duration - $h * 60;

        return $h > 0 ? "{$h}h {$m} min." : "{$m} min.";
    }

    /**
     * Link do tego kursu.
     */
    public function link(): string
    {
        return url('/course/' . $this->slug);
    }

    /**
     * Link do rozpocz??cia nauki tego kursu.
     */
    public function learnUrl(): string
    {
        return url('/learn/course/' . $this->slug);
    }

    /**
     * Link do ekranu zako??czenia kursu.
     */
    public function finishedUrl(): string
    {
        return url('/learn/course/' . $this->slug . '/finished');
    }

    /**
     * Zwraca sformatowany tekst stopnia trudno??ci.
     */
    public function difficulty(): string
    {
        switch ($this->difficulty) {
            case 1:
                return '??atwa';
            case 2:
                return '??rednia';
            case 3:
                return 'Trudna';
        }

        return '';
    }

    public function nextLessonLink($lesson_id = null): string
    {
        if (empty($lesson_id)) {
            return $this->learnUrl();
        }

        $user = Auth::user();

        $order = $this->visibleLessons($user)
            ->where('lesson_id', $lesson_id)
            ->pluck('position')
            ->first();

        $next = $this->visibleLessons($user)->where('position', $order + 1)->first();

        if (is_null($next)) {
            $lesson_ids = $this->visibleLessons($user)->pluck('lesson_id')->all();

            $next = $user
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
     * Zwraca link do nast??pnego nieuko??czonego elementu w tym kursie.
     */
    public function next(): string
    {
        $user = Auth::user();

        // Czy zosta??a jaka?? lekcja do uko??czenia?
        foreach ($this->visibleLessons($user)->get() as $lesson) {
            if (!$user->hasFinishedLesson($lesson->id)) {
                return $lesson->learnUrl($this);
            }
        }

        // Czy zosta?? jaki?? test do uko??czenia?
        foreach ($this->quizzes as $quiz) {
            if (!$user->hasFinishedQuiz($quiz->id)) {
                return $quiz->learnUrl();
            }
        }

        // Doszli??my tutaj, czyli nie ma nic wi??cej.
        // Mo??na sprawdzi??, czy kurs jest zako??czony i zwr??ci?? link.
        if (!$user->hasFinishedCourse($this->id)) {
            $this->finish();
        }

        return $this->finishedUrl();
    }

    /**
     * U??ytkownik uko??czy?? ten kurs.
     */
    public function finish(): self
    {
        $this->users()
            ->updateExistingPivot(
                Auth::user()->id,
                ['finished_at' => Carbon::now()]
            );

        if (!empty($this->certificate)) {
            UserCertificate::create([
                'user_id'        => Auth::user()->id,
                'certificate_id' => $this->certificate->id,
                'course_id'      => $this->id,
            ]);
        }

        Proof::createFinishedCourse(Auth::user(), $this);

        return $this;
    }

    /**
     * Nazwa do wy??wietlania w koszyku.
     */
    public function cartName(): string
    {
        return 'Kurs #' . $this->id . ' - ' . $this->title;
    }

    /**
     * Link usuwania z koszyka.
     */
    public function removeLink(Order $order): string
    {
        return url('/order/' . $order->id . '/course/' . $this->id . '/remove');
    }

    /**
     * Zwraca liczb?? os??b zapisanych na ten kurs.
     * @return [type] [description]
     */
    public function getUsersCountAttribute(): int
    {
        $course_id = $this->id;

        return Cache::remember('course_users_count_' . $this->id,
            60 * 12,
            function () use ($course_id) {
                return DB::table('course_user')
                    ->where('course_id', $course_id)
                    ->count();
            }
        );
    }

    /**
     * Zwraca ocen?? dla aktualnego u??ytkownika.
     */
    public function getRatingAttribute()
    {
        if (Auth::check()) {
            return Rating::where('user_id', Auth::user()->id)
                ->where('course_id', $this->id)
                ->first();
        } else {
            return null;
        }
    }

    /**
     * Zwraca ??redni?? warto???? ocen dla tego kursu.
     */
    public function getAvgRatingAttribute(): float
    {
        return (float) $this->ratings()->avg('rating');
    }

    /**
     * Zwraca liczb?? ocen dla tego kursu.
     */
    public function getRatingsCountAttribute(): int
    {
        return $this->ratings()->count();
    }

    public function getRealDelayAttribute(): int
    {
        if (Auth::check()) {
            return max(0, $this->cumulative_delay - Auth::user()->current_day);
        }

        return $this->cumulative_delay;
    }

    /**
     * Przelicza na nowo cumulative_delay po zmianie kolejno??ci.
     */
    public static function reorder(): void
    {
        $courses = static::query()->orderBy('position', 'asc')->get();

        $sum = 0;

        foreach ($courses as $course) {
            $sum = $sum + $course->delay;
            $course->cumulative_delay = $sum;
            $course->save();
        }
    }

    public function __toString()
    {
        return 'Kurs: ' . $this->title;
    }

    public function isSpecialAccess(): bool
    {
        return $this->is_special_access;
    }

    public function isSystematic(): bool
    {
        return $this->is_systematic;
    }

    public function hasLogbook(): bool
    {
        return $this->logbooks->count() > 0;
    }

    public function shouldShowLessonPreview(): bool
    {
        if ($this->isSpecialAccess()) {
            return true;
        }

        if ($this->isSystematic()) {
            return false;
        }

        return true;
    }

    public function scopeSearch($query, string $search = null)
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        });
    }

    public function scopeWithoutSpecial($query)
    {
        return $query->where('is_special_access', false);
    }

    public function scopeWithoutSpecialExcept($query, array $accessIds = [])
    {
        return $query->where(function ($q) use ($accessIds) {
            return $q->where('is_special_access', false)
                ->orWhereIn('id', $accessIds);
        });
    }

    public function getLabelAttribute()
    {
        return $this->title;
    }
}
