<?php
namespace App\Repositories;

use App\AccessDay;
use App\User;
use Carbon\Carbon;

class AccessDaysRepository
{
    public function sync(User $user = null, Carbon $toDate = null, Carbon $fromDate = null)
    {
        if ($user === null || $toDate === null) {
            return;
        }

        if ($fromDate === null) {
            $current = Carbon::now();
        } else {
            $current = clone $fromDate;
        }

        $end = (clone $toDate)->endOfDay();

        while ($current->lte($end)) {
            AccessDay::firstOrCreate([
                'user_id' => $user->id,
                'date'    => $current->format('Y-m-d'),
            ]);

            $current->addDay();
        }
    }

    public function grantAccessMonths(User $user, int $months)
    {
        $lastDay = $this->getLastAccessDay($user);

        $toDay = (clone $lastDay)->addMonths($months);

        $this->sync($user, $toDay, $lastDay);
    }

    public function getLastAccessDay(User $user) : Carbon
    {
        /** @var AccessDay $lastDay */
        $lastDay = $user->days()
            ->future()
            ->orderBy('date', 'desc')
            ->first();

        if ($lastDay === null) {
            return Carbon::now();
        }

        return Carbon::parse($lastDay->date);
    }
}
