<?php
namespace App\Fakturownia;

use App\Fakturownia\Exceptions\InvoiceException;
use App\Order;
use App\Repositories\OrdersRepository;

class OrderInvoice extends AbstractInvoice
{
    /** @var Order */
    protected $item;

    public function generate() : int
    {
        if ($this->item->invoiceId() !== null) {
            return $this->item->invoiceId();
        }

        $response = $this->client->addInvoice($this->getAttributes());

        if ($this->isInvalidResponse($response)) {
            throw new InvoiceException(array_get($response, 'response', ''));
        }

        $this->invoiceId = data_get($response, 'response.id');

        app(OrdersRepository::class)->attachInvoice($this->item, $this->invoiceId);

        return $this->invoiceId;
    }

    public function sendEmail()
    {
        if ($this->invoiceId !== null) {
            return $this->client->sendInvoice($this->invoiceId);
        }

        return null;
    }

    protected function getClientName() : string
    {
        $user = $this->item->user;

        if (!empty($user->company_name)) {
            return implode(', ', array_filter([
                $user->company_name,
                $user->address,
            ]));
        }

        return $user->name;
    }

    protected function getClientTaxId() : string
    {
        return $this->item->user->taxid ?? '';
    }

    protected function getPositions() : array
    {
        if ($this->item->is_full_access || $this->item->is_easy_access) {
            return [
                [
                    'name'              => $this->customDescription ?? $this->item->description,
                    'tax'               => 23,
                    'total_price_gross' => $this->item->total(),
                    'quantity'          => 1,
                ],
            ];
        }

        $positions = [];

        foreach ($this->item->quick_sales as $quickSale) {
            $positions[] = [
                'name'              => $this->customDescription ?? $quickSale->name,
                'tax'               => 23,
                'total_price_gross' => $this->item->total(),
                'quantity'          => 1,
            ];
        }

        return $positions;
    }

    public function getDownloadUrl() : ?string
    {
        return $this->client->getInvoiceUrl($this->item->invoiceId());
    }

    protected function attachInvoiceToItem($invoiceId)
    {
        app(OrdersRepository::class)->attachInvoice($this->item, $this->invoiceId);
    }
}
