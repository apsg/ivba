<?php
namespace App\Events;

use App\QuickSale;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuickSaleConfirmedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    const EVENTNAME = 'quicksale';

    /** @var User */
    public $user;

    /** @var QuickSale */
    public $quicksale;

    public function __construct(User $user, QuickSale $quickSale)
    {
        $this->user = $user;
        $this->quicksale = $quickSale;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
