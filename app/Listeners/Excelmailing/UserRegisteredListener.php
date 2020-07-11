<?php
namespace App\Listeners\Excelmailing;

use App\Events\UserRegisteredEvent;
use Gacek\IExcel\IExcel;

class UserRegisteredListener
{
    public function handle(UserRegisteredEvent $event)
    {
        if (app()->environment() === 'testing') {
            return;
        }

        app(IExcel::class)
            ->excelmailing()
            ->register($event->user->email ?? null);
    }
}
