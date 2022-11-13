<?php
namespace App\Domains\Posts\Actions;

use App\User;

class ClearPostDisplaysAction
{
    public function execute()
    {
        User::update([
            'has_seen_posts' => false,
        ]);
    }
}
