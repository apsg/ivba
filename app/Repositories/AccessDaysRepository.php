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
}