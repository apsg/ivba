<?php
namespace App\Repositories;

use App\Order;

class OrdersRepository
{
    public function attachInvoice(Order $order, int $invoiceId) : Order
    {
        $order->update([
            'invoice_id' => $invoiceId,
        ]);

        return $order;
    }

    public function create(array $attributes) : Order
    {
        return Order::create($attributes);
    }
}
