<?php
namespace App\Events;

use App\Order;
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

    /** @var Order|null */
    public $order;

    public function __construct(User $user, QuickSale $quickSale, Order $order = null)
    {
        $this->user = $user;
        $this->quicksale = $quickSale;
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
