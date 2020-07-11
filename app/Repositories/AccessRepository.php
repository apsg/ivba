<?php
namespace App\Repositories;

use App\Access;
use App\Interfaces\AccessableContract;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AccessRepository
{
    /**
     * Przyznaj użytkownikowi dostęp do elementu na X dni.
     * @param int $user_id [description]
     * @param model   $item [description]
     * @param int $days [description]
     * @return [type]          [description]
     */
    public function grant(User $user, AccessableContract $item, int $days = null) : Access
    {
        /** @var Access $access */
        $access = Access::where([
            'user_id'         => $user->id,
            'accessable_type' => get_class($item),
            'accessable_id'   => $item->id,
        ])->first();

        if ($access === null) {
            return Access::create([
                'user_id'         => $user->id,
                'accessable_type' => get_class($item),
                'accessable_id'   => $item->id,
                'expires_at'      => $days === null ? null : Carbon::now()->addDays($days),
            ]);
        }

        if ($days === null) {
            $access->update([
                'expires_at' => null,
            ]);

            return $access;
        }

        // jeśli dostęp istnieje, ale wygasł, aktywujemy
        if ($access->expires_at->isPast()) {
            $access->update([
                'expires_at' => Carbon::now()->addDays($days),
            ]);

            return $access;
        } else {
            // jeśli dostęp istnieje - przedłużamy
            $access->update([
                'expires_at' => $access->expires_at->addDays($days),
            ]);

            return $access;
        }
    }

    public function has(User $user, AccessableContract $item)
    {
        return Access::forUser($user)
            ->forItem($item)
            ->valid()
            ->exists();
    }
}
