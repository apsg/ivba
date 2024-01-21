<?php
namespace App\Domains\Learn;

use App\User;
use Illuminate\Support\Facades\Cache;

class QuestionsService
{
    const CACHE_KEY = 'questions-cache-user-';

    public function decrement(User $user): int
    {
        $uses = max($this->getUses($user) - 1, 0);

        Cache::remember($this->getCacheKey($user),
            $this->getCooldownInMinutes(),
            function () use ($uses) {
                return $uses;
            }
        );

        return $uses;
    }

    public function hasLimit(User $user): bool
    {
        return $this->getUses($user) > 0;
    }

    protected function getCacheKey(User $user): string
    {
        return static::CACHE_KEY . $user->id;
    }

    protected function getUses(User $user): int
    {
        return Cache::get($this->getCacheKey($user), config('ivba.questions.uses'));
    }

    protected function getCooldownInMinutes(): int
    {
        return 1; // config('ivba.questions.cooldown_days') * 60 * 24;
    }
}
