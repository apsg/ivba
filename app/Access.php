<?php
namespace App;

use App\Interfaces\AccessableContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Access.
 *
 * @property int         $id
 * @property int         $user_id
 * @property string|null $accessable_type
 * @property int|null    $accessable_id
 * @property Carbon|null $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model  $accessable
 * @property-read User   $user
 * @method Builder forUser(User $user)
 * @method Builder forItem(AccessableContract $item)
 * @method Builder valid()
 * @mixin \Eloquent
 */
class Access extends Model
{
    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Wszystkie obiekty z dostępami.
     */
    public function accessable()
    {
        return $this->morphTo();
    }

    /**
     * Użytkownik, któremu przyznano ten dostęp.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope dla dostępów, które nie wygasły.
     */
    public function scopeValid($query)
    {
        $query->where(function ($q) {
            $q->whereNull('expires_at')
                ->orWhere('expires_at', '>', Carbon::now());
        });
    }

    public function scopeForUser($query, User $user)
    {
        $query->where('user_id', '=', $user->id);
    }

    public function scopeForItem($query, AccessableContract $item)
    {
        $query->where('accessable_id', '=', $item->id)
            ->where('accessable_type', '=', get_class($item));
    }
}
