<?php
namespace App\Listeners\Excelmailing;

use App\Events\UserPaidAccessFinished;
use Gacek\IExcel\IExcel;

class UserAccessFinishedListener
{
    public function handle(UserPaidAccessFinished $event)
    {
        app(IExcel::class)
            ->excelmailing()
            ->expired($event->user->email ?? null);
    }
}
