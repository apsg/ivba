<?php
namespace App\Services;

use App\Point;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RankingService
{
    const RANKING_CACHE_KEY = 'ranking';
    const RANKING_CACHE_DURATION = 10;

    /**
     * @param User|int|null $user
     * @param int           $points
     * @throws \Exception
     */
    public function grant($user = null, int $points = 1, Carbon $customDate = null) : void
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

        Point::create(array_filter([
            'user_id'    => $userId,
            'points'     => $points,
            'created_at' => $customDate,
        ]));
    }

    public function grantForQuiz($user = null, $customDate = null)
    {
        if ($customDate !== null) {
            $customDate = Carbon::parse($customDate);
        }

        $this->grant($user, config('rating.quiz'), $customDate);

        $this->clearCachedRating();
    }

    public function grantForLesson($user = null, $customDate = null)
    {
        if ($customDate !== null) {
            $customDate = Carbon::parse($customDate);
        }

        $this->grant($user, config('rating.lesson'), $customDate);

        $this->clearCachedRating();
    }

    public function getRanking(Carbon $start = null, Carbon $end = null) : Collection
    {
        return \Cache::remember(self::RANKING_CACHE_KEY
            . ($start->timestamp ?? 'all')
            . ($end->timestamp ?? 'all'),
            self::RANKING_CACHE_DURATION,
            function () use ($start, $end) {
                \DB::statement('SET @row_number = 0;');

                $query = Point::select(
                    'user_id',
                    \DB::raw('sum(points.points) as points'),
                    \DB::raw('(@row_number:=@row_number + 1) AS position'),
                    'users.name'
                )->join('users', 'points.user_id', '=', 'users.id')
                    ->groupBy('points.user_id')
                    ->orderBy('points.points', 'desc');

                if ($start !== null) {
                    $query = $query->where('points.created_at', '>=', $start);
                }

                if ($end !== null) {
                    $query = $query->where('points.created_at', '<=', $end);
                }

                return $query->get()->sortBy('points');
            });
    }

    public function getThisMonthRanking()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        return $this->getRanking($start, $end);
    }

    public function clearCachedRating()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        \Cache::forget(self::RANKING_CACHE_KEY . 'allall');
        \Cache::forget(self::RANKING_CACHE_KEY . $start->timestamp . $end->timestamp);
    }

    public function getUserPosition(User $user) : int
    {
        return $this->getRanking()
                ->where('user_id', $user->id)
                ->first()
                ->position ?? 0;
    }

    public function getUserPoints(User $user) : int
    {
        return $this->getRanking()
                ->where('user_id', $user->id)
                ->first()
                ->points ?? 0;
    }

    public function getUserPointsThisMonth(User $user) : int
    {
        return $this->getThisMonthRanking()
                ->where('user_id', $user->id)
                ->first()
                ->points ?? 0;
    }

    public function getUserMonthlyPosiotion(User $user) : int
    {
        return $this->getThisMonthRanking()
                ->where('user_id', $user)
                ->first()
                ->position ?? 0;
    }

    public function getTotalUsers() : int
    {
        return $this->getRanking()->count();
    }

    public function getTotalUsersThisMonth() : int
    {
        return $this->getThisMonthRanking()->count();
    }
}