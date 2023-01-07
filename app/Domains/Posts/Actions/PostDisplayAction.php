<?php
namespace App\Domains\Posts\Actions;

use App\Domains\Posts\Models\PostDisplay;
use App\User;
use Illuminate\Support\Arr;

class PostDisplayAction
{
    public function execute(User $user, array $wpPost): void
    {
        PostDisplay::firstOrCreate([
            'user_id' => $user->id,
            'post_id' => Arr::get($wpPost, 'id'),
        ]);
    }
}
