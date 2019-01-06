<?php
namespace App;

use App\Events\SubscriptionCancelled;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * @property Carbon    valid_until
 * @property-read User user
 */
class Subscription extends Model
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_CANCELLED = 'Cancelled';

    protected $guarded = [];

    protected $casts = [
        'valid_until' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('created_at');
    }

    /**
     * Czy dana subskrypcja jest aktywna
     * @return boolean [description]
     */
    public function isValid()
    {
        return $this->valid_until->isFuture();
    }

    public function cancel()
    {
        $this->update([
            'is_active' => false,
        ]);

        event(new SubscriptionCancelled($this));

        return $this;
    }
}
