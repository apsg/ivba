<?php
namespace App\Services;

use App\Point;
use App\User;

class PointsService
{
    public function grant(User $user = null, int $points = 1)
    {
        if ($user === null) {
            return;
        }

        if ($points < 1) {
            throw new \Exception('Points must be positive');
        }

        Point::create([
            'user_id' => $user->id,
            'points'  => $points,
        ]);
    }
}