<?php
namespace App\Repositories;

use App\Access;
use App\Course;
use App\Interfaces\AccessableContract;
use App\Lesson;
use App\User;
use Carbon\Carbon;

class AccessRepository
{
    public function grant(User $user, AccessableContract $item, int $days = null) : Access
    {
        /** @var Access $access */
        $access = Access::where([
            'user_id'         => $user->id,
            'accessable_type' => get_class($item),
            'accessable_id'   => $item->id,
        ])->first();

        if ($access === null) {
            $this->assignToUser($user, $item);

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

    public function grantFullAccess(User $user, int $days = 1)
    {
        $user->updateFullAccess($days);
    }

    public function has(User $user, AccessableContract $item)
    {
        return Access::forUser($user)
            ->forItem($item)
            ->valid()
            ->exists();
    }

    public function revoke(User $user, AccessableContract $item)
    {
        return Access::where([
            'user_id'         => $user->id,
            'accessable_type' => get_class($item),
            'accessable_id'   => $item->id,
        ])->delete();
    }

    protected function assignToUser(User $user, AccessableContract $item)
    {
        if ($item instanceof Course && !$user->courses()->where('courses.id', $item->id)->exists()) {
            $user->courses()->attach($item->id);
        }

        if ($item instanceof Lesson && !$user->lessons()->where('lessons.id', $item->id)->exists()) {
            $user->lessons()->attach($item->id);
        }
    }

    public function getCourseAccessIdsForUser(User $user = null) : array
    {
        if ($user === null) {
            return [];
        }

        return Access::where('user_id', $user->id)
            ->where('accessable_type', Course::class)
            ->select('accessable_id')
            ->get()
            ->pluck('accessable_id')
            ->toArray();
    }
}
