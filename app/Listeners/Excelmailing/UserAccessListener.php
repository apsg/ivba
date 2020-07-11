<?php
namespace App\Listeners\Excelmailing;

use Gacek\IExcel\IExcel;

class UserAccessListener
{
    public function handle($event)
    {
        app(IExcel::class)
            ->excelmailing()
            ->access($event->user->email ?? null);
    }
}
