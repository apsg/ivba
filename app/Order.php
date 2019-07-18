<?php
namespace App;

use App\Events\QuickSaleConfirmedEvent;
use App\Events\UserPaidForAccess;
use App\Notifications\OrderConfirmed;
use App\Repositories\AccessDaysRepository;
use App\Repositories\AccessRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @package App
 * @property string|null                 external_payment_id
 * @property Carbon                      confirmed_at
 * @property int                         duration
 * @property-read User                   user
 * @property int                         $id
 * @property int                         $user_id
 * @property bool                        $is_full_access
 * @property bool                        is_easy_access
 * @property Carbon|null                 $created_at
 * @property Carbon|null                 $updated_at
 * @property float|null                  $final_total
 * @property float|null                  $price
 * @property string|null                 $description
 * @property-read Collection|Coupon[]    $coupons
 * @property-read Collection|QuickSale[] quick_sales
 * @method static Builder|Order confirmed()
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    /**
     * Użytkownik, który wygenerował zamówienie
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lista kodów rabatowych dodanych do tego zamówienia
     */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function quick_sales()
    {
        return $this->morphedByMany(QuickSale::class, 'orderable');
    }

    /**
     * Suma cen elementów (przed ewentualnymi rabatami)
     */
    public function sum() : float
    {
        if ($this->is_full_access || $this->is_easy_access) {
            return $this->price;
        }

        return $this->countOrderablesSum();
    }

    protected function countOrderablesSum() : float
    {
        $quickSalesSum = $this->quick_sales()->sum('price');

        return $quickSalesSum;
    }

    /**
     * Suma końcowa
     */
    public function total() : float
    {
        $total = $this->sum();
        foreach ($this->coupons as $coupon) {
            $total = $coupon->apply($total);
        }

        return $total;
    }

    /**
     * Kwota netto
     */
    public function netto() : float
    {
        return number_format($this->total() / 1.23, 2);
    }

    /**
     * Kwota podatku
     */
    public function tax() : float
    {
        return $this->total() - $this->netto();
    }

    /**
     * Potwierdź zamówienie
     */
    public function confirm(string $externalId = null) : bool
    {
        if (!is_null($this->confirmed_at)) {
            return false;
        }

        $this->confirmed_at = Carbon::now();
        $this->external_payment_id = $externalId;

        if ($this->is_full_access) {
            $days = Carbon::now()->addMonths($this->duration)->diffInDays();
            $this->user->updateFullAccess($days);
        }

        if ($this->is_easy_access) {
            app(AccessDaysRepository::class)
                ->grantAccessMonths($this->user, $this->duration);
        }

        $accessRepository = app(AccessRepository::class);

        foreach ($this->quick_sales as $quickSale) {
            if ($quickSale->course !== null) {
                $accessRepository->grant($this->user, $quickSale->course);
                $this->user->courses()->attach($quickSale->course);
            }
            event(new QuickSaleConfirmedEvent($this->user, $quickSale));
        }

        // "Skasuj" wszystkie użyte kody rabatowe w tym zamówieniu
        foreach ($this->coupons as $coupon) {
            $coupon->uses_left -= 1;
            $coupon->save();
        }

        $this->save();

        // Odpalamy zdarzenie
        event(new UserPaidForAccess($this->user));

        // Powiadamiamy użytkownika
        $this->user->notify(new OrderConfirmed($this));

        return true;
    }

    public function isEmpty() : bool
    {
        if ($this->is_full_access) {
            return false;
        }

        return true;
    }

    public function scopeConfirmed($query)
    {
        $query->where(function ($q) {
            $q->whereNotNull('confirmed_at')
                ->orWhereNotNull('external_payment_id');
        });
    }

    public function setEasyAccess(int $duration) : self
    {
        $this->update([
            'is_full_access' => false,
            'is_easy_access' => true,
            'duration'       => $duration,
            'description'    => 'Dostęp do strony ' . config('app.name') . ' ' . $duration . ' mies.',
            'price'          => $duration * config('ivba.subscription_price'),
        ]);

        return $this;
    }

    public function clear() : self
    {
        $this->update([
            'is_full_access' => false,
            'is_easy_access' => false,
            'duration'       => 0,
            'description'    => '',
            'price'          => 0,
        ]);
        $this->coupons()->detach();
        $this->quick_sales()->detach();

        return $this;
    }

    public function getDescription() : string
    {
        if ($this->quick_sales()->count() > 0) {
            return $this->quick_sales[0]->name;
        }

        return $this->description ?? '';
    }
}
