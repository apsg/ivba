<?php
namespace App;

use App\Exceptions\NoCouponUsesLeftException;
use App\Repositories\AccessRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Coupon.
 *
 * @property string                   code
 * @property int                      uses_left
 * @property int                      type
 * @property int                      $id
 * @property float                    amount
 * @property Carbon|null              created_at
 * @property Carbon|null              updated_at
 *
 * @property-read string              description
 * @property-read string              type_text
 *
 * @property-read Collection|Order[]  $orders
 * @property-read Collection|Course[] $courses
 * @property-read Collection|User[]   $users
 *
 * @method static usable() Builder|Coupon
 * @method static forQuickSale() Builder|Coupon
 *
 */
class Coupon extends Model
{
    protected $guarded = [];

    const TYPE_VALUE = 1;
    const TYPE_PERCENT = 2;

    const TYPE_SUBSCRIPTION_VALUE = 3;
    const TYPE_SUBSCRIPTION_PERCENT = 4;

    const TYPE_COURSE_ACCESS = 5;
    const TYPE_FULL_ACCESS = 6;

    protected $casts = [
        'type'   => 'integer',
        'amount' => 'float',
    ];

    protected $appends = [
        'description',
    ];

    /**
     * Zamówienia, do których użyto tego kodu.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }

    /**
     * Zastosuj kupon i zwróć cenę po obniżce.
     */
    public function apply($total)
    {
        if ($this->uses_left <= 0) {
            return $total;
        }

        if ($this->type == self::TYPE_VALUE || $this->type == self::TYPE_SUBSCRIPTION_VALUE) {
            // Kupon złotowy
            return max(0, $total - $this->amount);
        }

        if ($this->type == self::TYPE_PERCENT || $this->type == self::TYPE_SUBSCRIPTION_PERCENT) {
            // kupon procentowy
            return max(0, (100 - $this->amount) * $total / 100);
        }

        return $total;
    }

    /**
     * Zwraca link usuwania z koszyka.
     */
    public function removeLink(Order $order)
    {
        return url('/order/' . $order->id . '/remove_coupon/' . $this->id);
    }

    /**
     * Zwraca sformatowaną wartość kuponu.
     */
    public function valueFormatted()
    {
        if ($this->type == static::TYPE_COURSE_ACCESS) {
            return $this->courses->pluck('title')->implode(' | ');
        }

        if ($this->type == static::TYPE_FULL_ACCESS) {
            return '1 rok';
        }

        return $this->amount . ($this->type == static::TYPE_VALUE ? ' PLN' : ' %');
    }

    /**
     * Zwraca link edycji kuponu.
     */
    public function editLink()
    {
        return url('/admin/coupon/' . $this->id);
    }

    /**
     * Zwraca link usuwania kuponu.
     */
    public function deleteLink()
    {
        return url('/admin/coupon/' . $this->id . '/delete');
    }

    public function getTypeTextAttribute()
    {
        if ($this->type == self::TYPE_VALUE) {
            return 'Złotowy';
        }

        if ($this->type == self::TYPE_PERCENT) {
            return 'Procentowy';
        }

        if ($this->type == self::TYPE_SUBSCRIPTION_VALUE) {
            return 'Złotowy - subskrypcje';
        }

        if ($this->type == self::TYPE_SUBSCRIPTION_PERCENT) {
            return 'Procentowy - subskrypcje';
        }

        if ($this->type == self::TYPE_COURSE_ACCESS) {
            return 'Dostęp do kursu';
        }

        if ($this->type == self::TYPE_FULL_ACCESS) {
            return 'Pełen dostęp';
        }

        return 'nieznany';
    }

    public function isSubscription()
    {
        if ($this->type == self::TYPE_SUBSCRIPTION_PERCENT) {
            return true;
        }

        if ($this->type == self::TYPE_SUBSCRIPTION_VALUE) {
            return true;
        }

        return false;
    }

    public function use() : self
    {
        if ($this->alreadyUsedBy(Auth::user())) {
            return $this;
        }

        if ($this->uses_left <= 0) {
            throw new NoCouponUsesLeftException();
        }

        $this->uses_left -= 1;
        $this->save();

        if ($this->type == static::TYPE_COURSE_ACCESS) {
            $accessRepo = app(AccessRepository::class);
            /** @var User $user */
            $user = Auth::user();

            foreach ($this->courses as $course) {
                $accessRepo->grant($user, $course);
                $user->courses()->attach($course->id);
            }
        }

        if ($this->type == static::TYPE_FULL_ACCESS) {
            app(AccessRepository::class)->grantFullAccess(Auth::user(), 366);
        }

        $this->users()->attach(Auth::user()->id);

        return $this;
    }

    public function alreadyUsedBy(User $user) : bool
    {
        return $this->users()
            ->where('id', $user->id)
            ->exists();
    }

    public function scopeUsable(Builder $query)
    {
        return $query->where('uses_left', '>', 0);
    }

    public function scopeForQuickSale(Builder $builder)
    {
        return $builder->whereIn('type', [static::TYPE_PERCENT, static::TYPE_VALUE]);
    }

    public function getDescriptionAttribute()
    {
        return $this->valueFormatted();
    }

    public function isValidForQuickSale() : bool
    {
        if ($this->uses_left <= 0) {
            return false;
        }

        if (!in_array($this->type, [static::TYPE_PERCENT, static::TYPE_VALUE])) {
            return false;
        }

        return true;
    }
}
