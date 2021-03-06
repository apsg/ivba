<?php
namespace App;

use App\Events\UserRegisteredEvent;
use App\Notifications\PasswordReset;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User.
 *
 * @property string                         name
 * @property string                         email
 * @property string                         password
 * @property-read Carbon                    full_access_expires
 * @property Carbon                         last_proof_at
 * @property int                            last_proof_id
 * @property int                            days_bought
 * @property Carbon                         expires_at
 * @property string                         card_token
 * @property Carbon                         changed_password_at
 * @property Carbon                         unsubscribed_at
 * @property string|null                    first_name
 * @property string|null                    last_name
 * @property string|null                    address
 * @property string|null                    taxid
 * @property string|null                    company_name
 * @property string|null                    street
 * @property string|null                    postcode
 * @property string|null                    city
 * @property string|null                    partner_key
 * @property-read string                    partner_uniqid
 * @property int|null                       partner_id
 * @property-read User|null                 partner
 * @property-read Collection|User[]         refs
 * @property-read string                    full_name
 * @property-read HasOne|Subscription       subscription
 * @property int                            $id
 * @property string|null                    $remember_token
 * @property Carbon|null                    $created_at
 * @property Carbon|null                    $updated_at
 * @property int                            $isadmin
 * @property string|null                    $phone
 * @property string|null                    $deleted_at
 * @property-read int                       total_points
 * @property-read Collection|Answer[]       $answers
 * @property-read Collection|Course[]       $courses
 * @property-read Collection|AccessDay[]    $days
 * @property-read Collection|Email[]        $emails
 * @property-read mixed                     $current_day
 * @property-read mixed                     $remaining_days
 * @property-read Proof|null                $last_proof
 * @property-read Collection|Lesson[]       $lessons
 * @property-read Collection|Order[]        $orders
 * @property-read Collection|Order[]        $quick_sale_order
 * @property-read Collection|Quiz[]         $quizzes
 * @property-read Collection|Subscription[] $subscriptions
 * @property-read Collection|Payment[]      $payments
 * @property-read Collection|Access[]       $accesses
 * @method static Builder|User followups()
 * @method static Builder|User expired()
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'full_access_expires',
        'last_proof_at',
        'last_proof_id',
        'days_bought',
        'expires_at',
        'card_token',
        'changed_password_at',
        'unsubscribed_at',
        'first_name',
        'last_name',
        'address',
        'partner_key',
        'partner_id',
        'isadmin',
        'phone',
        'taxid',
        'street',
        'postcode',
        'city',
        'company_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'card_token',
    ];

    protected $casts = [
        'full_access_expires' => 'datetime',
        'unsubscribed_at'     => 'datetime',
        'last_proof_at'       => 'datetime',
        'expires_at'          => 'datetime',
        'changed_password_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => UserRegisteredEvent::class,
    ];

    /**
     * Kursy rozpocz??te przez tego u??ytkownika.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('finished_at')
            ->withTimestamps();
    }

    /**
     * Lekcje rozpocz??te przez tego u??ytkownika.
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)
            ->withPivot(['finished_at', 'course_id'])
            ->withTimestamps();
    }

    /**
     * Testy tego u??ytkownika.
     */
    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class)
            ->withPivot('finished_date', 'points', 'is_pass')
            ->withTimestamps();
    }

    /**
     * Odpowiedzi tego u??ytkownika.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Zam??wienia tego u??ytkownika.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function quick_sale_orders()
    {
        return $this->hasMany(Order::class)
            ->confirmed()
            ->has('quick_sales')
            ->with('quick_sales');
    }

    /**
     * Emaile wysy??ane do tego u??ytkownika.
     */
    public function emails()
    {
        return $this->morphMany(Email::class, 'to');
    }

    /**
     * Ostatni wys??any proof.
     */
    public function last_proof()
    {
        return $this->belongsTo(Proof::class, 'last_proof_id');
    }

    /**
     * Dni wykupione przez tego u??ytkownika.
     */
    public function days()
    {
        return $this->hasMany(AccessDay::class);
    }

    /**
     * Ostatni dzie?? dost??pu danego u??ytkownika.
     */
    public function lastDay()
    {
        $last = $this->days()->orderBy('date', 'desc')->first();

        if ($last) {
            return $last->date;
        } else {
            return null;
        }
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('valid_until', '>=', Carbon::now());
    }

    /**
     * Subskrypcje tego u??ytkownika.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this
            ->hasManyThrough(Payment::class, Subscription::class)
            ->whereNotNull('confirmed_at');
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function partner()
    {
        return $this->belongsTo(self::class, 'partner_id');
    }

    public function refs()
    {
        return $this->hasMany(self::class, 'partner_id');
    }

    public function accesses()
    {
        return $this->hasMany(Access::class)
            ->with('accessable');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class)
            ->withTimestamps();
    }

    /**
     * Aktywna subskrypcja tego u??ytkownika.
     * @return Subscription|null
     */
    public function currentSubscription()
    {
        $sub = $this->subscriptions()
            ->where('valid_until', '>=', Carbon::now())
            ->first();

        if ($sub) {
            return $sub;
        }

        return $this->subscriptions()
            ->where('valid_until', '>=', Carbon::now())
            ->first();
    }

    /**
     * Zwraca u??ytkownik??w, kt??rzy nie wypisali si?? z maili typu Followup.
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeFollowups($query)
    {
        return $query->whereNull('unsubscribed_at');
    }

    /**
     * Op??acone zam??wienia tego u??ytkownika.
     * @return [type] [description]
     */
    public function confirmedOrders()
    {
        return $this->orders()
            ->whereNotNull('confirmed_at')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Zwraca aktywne zam??wienie lub tworzy nowe.
     * @return Order [description]
     */
    public function getCurrentOrder() : Order
    {
        if ($order = $this->orders()
            ->whereNull('confirmed_at')
            ->whereNull('external_payment_id')
            ->first()) {
            return $order;
        } else {
            $order = new Order;
            $order->user()->associate($this);
            $order->save();

            return $order->fresh();
        }
    }

    /**
     * Zwraca URL do gravatara danego u??ytkownika.
     */
    public function gravatarUrl()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }

    /**
     * Czy dany u??ytkownik ma aktywny pe??en dost??p?
     */
    public function hasFullAccess()
    {
        return $this->full_access_expires && $this->full_access_expires->isFuture();
    }

    /**
     * Czy dany u??ytkownik rozpocz???? t?? lekcj???
     */
    public function hasStartedLesson($lesson_id)
    {
        return $this->lessons()->where('lesson_id', $lesson_id)->exists();
    }

    /**
     * Czy dany u??ytkownik rozpocz???? ten kurs?
     */
    public function hasStartedCourse($course_id)
    {
        return $this->courses()->where('course_id', $course_id)->exists();
    }

    /**
     * Czy u??ytkownik ju?? rozpocz???? ten kurs?
     */
    public function hasStartedQuiz($quiz_id)
    {
        return $this->quizzes()->where('quiz_id', $quiz_id)->exists();
    }

    /**
     * Czy dany u??ytkownik zako??czy?? t?? lekcj???
     */
    public function hasFinishedLesson($lesson_id)
    {
        return $this->lessons()
            ->where('lesson_id', $lesson_id)
            ->whereNotNull('finished_at')
            ->exists();
    }

    /**
     * Czy dany u??ytkownik uko??czy?? ten kurs?
     */
    public function hasFinishedCourse($course_id)
    {
        return $this->courses()
            ->where('course_id', $course_id)
            ->whereNotNull('finished_at')
            ->exists();
    }

    /**
     * Czy u??ytkownik uko??czy?? wszystkie lekcje z danego kursu.
     */
    public function hasFinishedAllLessons($course_id)
    {
        $lesson_ids = Course::findOrFail($course_id)->lessons->pluck('id');

        foreach ($lesson_ids as $lesson_id) {
            if (!$this->hasFinishedLesson($lesson_id)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Czy dany u??ytkownik uko??czy?? ten test?
     */
    public function hasFinishedQuiz($quiz_id)
    {
        return $this->quizzes()
            ->where('quiz_id', $quiz_id)
            ->whereNotNull('finished_date')
            ->exists();
    }

    /**
     * Czy u??ytkownik uko??czy?? wszystkie testy w danym kursie.
     */
    public function hasFinishedAllQuizzes($course_id)
    {
        $quiz_ids = Quiz::where('course_id', $course_id)->get()->pluck('id');

        foreach ($quiz_ids as $quiz_id) {
            if (!$this->hasFinishedQuiz($quiz_id)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Czy u??ytkownik zda?? ten test?
     */
    public function hasPassedQuiz($quiz_id)
    {
        return $this->quizzes()
            ->where('quiz_id', $quiz_id)
            ->whereNotNull('finished_date')
            ->where('is_pass', true)
            ->exists();
    }

    /**
     * Czy u??ytkownik zda?? wszystkie testy przypisane do tego kursu?
     */
    public function hasPassedAllQuizzes($course_id)
    {
        $quiz_ids = Quiz::where('course_id', $course_id)->get()->pluck('id');

        foreach ($quiz_ids as $quiz_id) {
            if (!$this->hasPassedQuiz($quiz_id)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Czy u??ytkownik uko??czy?? pozytywnie ten kurs?
     */
    public function hasPassedCourse($course_id)
    {
        return $this->hasFinishedAllLessons($course_id)
            && $this->hasPassedAllQuizzes($course_id);
    }

    /**
     * Aktualizuje pe??en dost??p o okre??lon?? liczb?? dni dost??pu.
     */
    public function updateFullAccess($days)
    {
        if (empty($this->full_access_expires) || $this->full_access_expires->isPast()) {
            $this->full_access_expires = Carbon::now()->addDays($days);
            $this->save();
        } else {
            $this->full_access_expires = $this->full_access_expires->addDays($days);
            $this->save();
        }

        return $this;
    }

    /**
     * Czy mo??na doda?? kolejny pe??en dost??p do tego konta?
     */
    public function canAddFullAccess()
    {
        if (is_null($this->full_access_expires) || $this->full_access_expires->isPast()) {
            return true;
        }

        if ($this->full_access_expires->isFuture() && $this->full_access_expires->diffInDays() < 365) {
            return true;
        }

        return false;
    }

    public function deleteLink()
    {
        return url('/admin/user/' . $this->id . '/delete');
    }

    public function sendPasswordLink()
    {
        return url('/admin/user/' . $this->id . '/send_password');
    }

    public function grantFullAccessLink()
    {
        return url('/admin/user/' . $this->id . '/grant_full_access');
    }

    public function editLink()
    {
        return url('/admin/user/' . $this->id);
    }

    public function unsubscribe()
    {
        $this->unsubscribed_at = Carbon::now();
        $this->emails->each->delete();
        flash('Nie b??dziesz ju?? otrzymywa?? powiadomie?? automatycznych');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token, $this->created_at->diffInMinutes() < 5));
    }

    public function getCurrentDayAttribute()
    {
        return $this->days()
            ->where('date', '<=', Carbon::now()->format('Y-m-d'))
            ->count();
    }

    /**
     * Ile dni dost??pu pozosta??o temu u??ytkownikowi.
     */
    public function getRemainingDaysAttribute()
    {
        return $this->days()
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->count();
    }

    public function getTotalPointsAttribute()
    {
        return $this->points()->sum('points');
    }

    /**
     * Dodaj okre??lon?? liczb?? dni.
     */
    public function addSubscriptionDays($days)
    {
        $last = $this->lastDay();

        if (!$last || $last->isPast()) {
            $last = Carbon::now();
            $this->days()->create([
                'date' => $last->format('Y-m-d'),
            ]);
        }

        for ($i = 0; $i < $days; $i++) {
            $last = $last->addDays(1);
            $this->days()->create([
                'date' => $last->format('Y-m-d'),
            ]);
        }

        return $this;
    }

    /**
     * ustaw dni subskrypcji do okre??lonej daty.
     */
    public function addSubscriptionDaysUntil(Carbon $date)
    {
        $current = clone $date;

        while (!$current->isPast()) {
            $this->days()->firstOrCreate([
                'date' => $current->format('Y-m-d'),
            ]);
            $current->subDays(1);
        }
        // dzisiejszy dzie?? ponownie, je??li za??apie si?? jako past
        $this->days()->firstOrCreate([
            'date' => $current->format('Y-m-d'),
        ]);
    }

    /**
     * Czy ten u??ytkownik ma aktywn?? subskrypcj??.
     */
    public function hasActiveSubscription()
    {
        return (bool)$this->currentSubscription();
    }

    /**
     * Czy u??ytkownik ma dost??p tego dnia.
     */
    public function hasDayAccess($date = null) : bool
    {
        $day = Carbon::parse($date);

        return $this->days()->where('date', $day->format('Y-m-d'))->exists();
    }

    /**
     * Zwraca imi?? i nazwisko.
     */
    public function getFullNameAttribute()
    {
        if (empty($this->first_name)) {
            return $this->name;
        }

        return $this->first_name . ' ' . $this->last_name;
    }

    public function activeSubscription()
    {
        /** @var Subscription $subscription */
        $subscription = $this->currentSubscription();

        if ($subscription === null) {
            return null;
        }

        if (!$subscription->isActive()) {
            return null;
        }

        return $subscription;
    }

    public function partnerLink()
    {
        return url('/p/' . $this->partner_uniqid);
    }

    public function getPartnerUniqidAttribute() : string
    {
        if (empty($this->partner_key)) {
            $this->update([
                'partner_key' => uniqid(),
            ]);
        }

        return $this->partner_key;
    }

    public function scopeExpired(Builder $builder)
    {
        $builder->where(function ($q) {
            $q->whereNull('full_access_expires')
                ->orWhere('full_access_expires', '<', Carbon::now());
        })->where(function ($q) {
            $q->doesntHave('subscription')
                ->orWhereHas('subscription', function (Builder $query) {
                    $query->where('cancelled_at', '<', Carbon::now());
                });
        });
    }
}
