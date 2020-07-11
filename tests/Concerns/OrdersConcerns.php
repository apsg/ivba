<?php
namespace Tests\Concerns;

use App\Order;

trait OrdersConcerns
{
    public function createOrder(array $attrubutes = []) : Order
    {
        return factory(Order::class)->create($attrubutes);
    }
}
