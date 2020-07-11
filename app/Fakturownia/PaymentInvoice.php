<?php
namespace App\Fakturownia;

use App\Payment;
use App\Repositories\PaymentRepository;

class PaymentInvoice extends AbstractInvoice
{
    /** @var Payment */
    protected $item;

    public function __construct(Payment $item)
    {
        parent::__construct($item);
    }

    protected function attachInvoiceToItem($invoiceId)
    {
        app(PaymentRepository::class)->attachInvoice($this->item, $invoiceId);
    }

    protected function getClientName() : string
    {
        $user = $this->item->subscription->user;

        if (! empty($user->last_name)) {
            return implode(', ', array_filter([
                $user->full_name,
                $user->address,
            ]));
        }

        return $user->name;
    }

    protected function getPositions() : array
    {
        $positions = [];

        $positions[] = [
            'name'              => $this->item->title,
            'tax'               => 23,
            'total_price_gross' => $this->item->amount,
            'quantity'          => 1,
        ];

        return $positions;
    }

    protected function getClientTaxId() : string
    {
        return $this->item->subscription->user->taxid ?? null;
    }
}
