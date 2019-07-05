<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Access
 *
 * @property int         $id
 * @property int         $user_id
 * @property string|null $accessable_type
 * @property int|null    $accessable_id
 * @property Carbon      $expires
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model  $accessable
 * @property-read User   $user
 * @mixin \Eloquent
 */
class Access extends Model
{

    protected $guarded = [];

    protected $casts = [
        'expires' => 'datetime',
    ];

    /**
     * Wszystkie obiekty z dostępami
     */
    public function accessable()
    {
        return $this->morphTo();
    }

    /**
     * Użytkownik, któremu przyznano ten dostęp
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope dla dostępów, które nie wygasły
     */
    public function scopeValid($query)
    {
        $query->where('expires', '>', Carbon::now());
    }

    /**
     * Przyznaj użytkownikowi dostęp do elementu na X dni
     * @param integer $user_id [description]
     * @param model   $item [description]
     * @param integer $days [description]
     * @return [type]          [description]
     */
    public static function grant($user_id, $item, $days)
    {

        if ($access = Access::where([
            'user_id'         => $user_id,
            'accessable_type' => get_class($item),
            'accessable_id'   => $item->id,
        ])->first()) {
            // jeśli dostęp istnieje, ale wygasł, aktywujemy
            if ($access->expires->isPast()) {
                $access->update([
                    'expires' => Carbon::now()->addDays($days),
                ]);

                return $access;
            } else {
                // jeśli dostęp istnieje - przedłużamy
                $access->expires = $access->expires->addDays($days);
                $access->save();

                return $access;
            }
        } else {
            return static::create([
                'user_id'         => $user_id,
                'accessable_type' => get_class($item),
                'accessable_id'   => $item->id,
                'expires'         => Carbon::now()->addDays($days),
            ]);
        }
    }

}
