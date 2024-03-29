<?php
namespace App;

use App\Domains\Quicksales\Models\CouponQuickSalePivot;
use App\Domains\Quicksales\Models\CourseQuickSalePivot;
use App\Interfaces\OrderableContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int                      id
 * @property string                   hash
 * @property string                   name
 * @property string|null              description
 * @property string                   rules_url
 * @property float                    price
 * @property float|null               full_price
 * @property int                      course_id
 * @property-read Course              course
 * @property bool                     is_full_data_required
 *
 * @property string                   message_email
 * @property string                   message_subject
 * @property string                   message_body
 *
 * @property string|null              redirect_url
 * @property string|null              file_url
 * @property string|null              campaign
 * @property string|null              baselinker_id
 * @property array|null               payments
 * @property string|null              mailerlite_group_id
 *
 * @property Carbon                   created_at
 * @property Carbon                   updated_at
 *
 * @property-read Collection|Course[] courses
 * @property-read string              link
 * @property-read Collection|Order[]  orders
 * @property-read Collection|Order[]  confirmed_orders
 * @property-read Collection|Coupon[] coupons
 */
class QuickSale extends Model implements OrderableContract
{
    protected $fillable = [
        'name',
        'hash',
        'description',
        'rules_url',
        'price',
        'full_price',
        'course_id',
        'message_email',
        'message_subject',
        'message_body',
        'redirect_url',
        'is_full_data_required',
        'file_url',
        'campaign',
        'baselinker_id',
        'payments',
        'mailerlite_group_id',
    ];

    protected $casts = [
        'is_full_data_required' => 'boolean',
        'payments'              => 'array',
    ];

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable');
    }

    public function confirmed_orders()
    {
        return $this->morphToMany(Order::class, 'orderable')
            ->confirmed();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->using(CourseQuickSalePivot::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class)
            ->using(CouponQuickSalePivot::class);
    }

    public function cartName(): string
    {
        return $this->name;
    }

    public function removeLink(Order $order): string
    {
        return ''; // We do not need it for this type of orderables
    }

    public function getLinkAttribute()
    {
        return url('/qs/' . $this->hash);
    }

    public function getHasCouponsAttribute(): bool
    {
        return $this->coupons->count() > 0;
    }
}
