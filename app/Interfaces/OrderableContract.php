<?php
namespace App\Interfaces;

use App\Order;

interface OrderableContract
{
    public function cartName();

    public function removeLink(Order $order);
}