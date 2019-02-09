<?php
namespace App\Listeners;

use App\Helpers\FollowupsHelper;

class FollowupsListener
{
    public function handle($event)
    {
        $followup = FollowupsHelper::getName(get_class($event));
    }
}