<?php
namespace App\Services;

use App\Point;
use App\User;

class PointsService
{
    /**
     * @param User|int|null $user
     * @param int           $points
     * @throws \Exception
     */
    public function grant($user = null, int $points = 1) : void
    {
        if ($user === null) {
            return;
        }

        if ($points < 1) {
            throw new \Exception('Points must be positive');
        }

        $userId = $user;

        if ($user instanceof User) {
            $userId = $user->id;
        }

        Point::create([
            'user_id' => $userId,
            'points'  => $points,
        ]);
    }

    public function grantForQuiz($user = null)
    {
        $this->grant($user, config('rating.quiz'));
    }

    public function grantForLesson($user = null)
    {
        $this->grant($user, config('rating.lesson'));
    }
}