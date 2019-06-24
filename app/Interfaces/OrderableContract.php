<?php
namespace App\Interfaces;

use App\Order;

interface OrderableContract
{
    public function cartName() : string;

    public function removeLink(Order $order) : string;
}
