<?php
namespace App\Fakturownia;

use App\Fakturownia\Client\InvoiceOceanClient;
use App\Fakturownia\Exceptions\InvoiceException;
use App\Order;
use App\Repositories\OrdersRepository;
use Carbon\Carbon;

class Invoice
{
    /** @var InvoiceOceanClient */
    protected $client;

    /** @var Order */
    protected $order;

    public function __construct(Order $order)
    {
        $this->client = new InvoiceOceanClient();
        $this->order = $order;
    }

    public function generate() : int
    {
        if ($this->order->invoice_id !== null) {
            return $this->order->invoice_id;
        }

        $response = $this->client->addInvoice($this->getAttributes());

        if ($response['success'] !== true) {
            throw new InvoiceException(array_get($response, 'response'));
        }

        $invoiceId = array_get($response, 'response.id');

        app(OrdersRepository::class)->attachInvoice($this->order, $invoiceId);

        return $invoiceId;
    }

    protected function getAttributes() : array
    {
        $now = Carbon::now()->format('Y-m-d');

        $attributes = [
            "kind"          => "vat",
            "number"        => null,
            "sell_date"     => $this->order->confirmed_at->format('Y-m-d'),
            "issue_date"    => $now,
            "payment_to"    => $now,
            "seller_name"   => "Mateusz Grabowski",
            "seller_tax_no" => "5252445767",
            "buyer_name"    => $this->getClientName(),
            "buyer_tax_no"  => "5252445767",
            "positions"     => $this->getPositions(),
        ];

        return $attributes;
    }

    protected function getClientName() : string
    {
        $user = $this->order->user;

        if (!empty($user->last_name)) {
            return implode(', ', array_filter([
                $user->full_name,
                $user->address,
            ]));
        }

        return $user->name;
    }

    protected function getPositions() : array
    {
        if ($this->order->is_full_access || $this->order->is_easy_access) {
            return [
                [
                    "name"              => $this->order->description,
                    "tax"               => 23,
                    "total_price_gross" => $this->order->total(),
                    "quantity"          => 1,
                ],
            ];
        }

        $positions = [];

        foreach ($this->order->quick_sales as $quickSale) {
            $positions[] = [
                "name"              => $quickSale->name,
                "tax"               => 23,
                "total_price_gross" => $quickSale->price,
                "quantity"          => 1,
            ];
        }

        return $positions;
    }
}
