<?php
namespace App\Services;

use App\User;

class PointsService
{
    public function grant(User $user, int $points = 1)
    {
        if($points < 1)
            throw new InvalidArgumentException('Points must be positive');
    }
}