<?php
namespace App\Listeners\Excelmailing;

use App\Events\UserPaidForAccess;
use Gacek\IExcel\IExcel;

class UserAccessListener
{
    public function handle(UserPaidForAccess $event)
    {
        app(IExcel::class)
            ->excelmailing()
            ->access($event->user->email ?? null);
    }
}