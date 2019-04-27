<?php
namespace App\Services;

use App\User;
use Carbon\Carbon;

class PartnerProgramService
{
    public function all()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        $userIds = User::wherenotNull('partner_id')
            ->where('created_at', '>', $startOfYear)
            ->get(['partner_id']);

        return User::whereIn('id', $userIds)
            ->with('refs')
            ->get()
            ->map(function (User $user) use ($startOfMonth, $startOfYear) {
                $user->refs_month = $user->refs->where('created_at', '>', $startOfMonth)->count();
                $user->refs_year = $user->refs->where('created_at', '>', $startOfYear)->count();

                return $user;
            });
    }
}