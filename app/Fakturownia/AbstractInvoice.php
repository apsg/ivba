<?php
namespace App\Fakturownia;

use App\Fakturownia\Client\InvoiceOceanClient;
use App\Fakturownia\Exceptions\InvoiceException;
use App\Interfaces\InvoicableContract;
use Carbon\Carbon;

abstract class AbstractInvoice
{
    /** @var InvoiceOceanClient */
    protected $client;

    /** @var InvoicableContract */
    protected $item;

    /** @var int|null */
    protected $invoiceId;

    public function __construct(InvoicableContract $item)
    {
        $this->client = new InvoiceOceanClient();
        $this->item = $item;
    }

    public function generate() : int
    {
        if ($this->item->hasInvoice()) {
            return $this->item->invoiceId();
        }

        $response = $this->client->addInvoice($this->getAttributes());

        if ($response['success'] !== true || data_get($response, 'response.code') === 'error') {
            throw new InvoiceException(array_get($response, 'response'));
        }

        $this->invoiceId = data_get($response, 'response.id');

        $this->attachInvoiceToItem($this->invoiceId);

        return $this->invoiceId;
    }

    public function sendEmail()
    {
        if ($this->invoiceId !== null) {
            return $this->client->sendInvoice($this->invoiceId);
        }

        return null;
    }

    public function getAttributes() : array
    {
        $now = Carbon::now()->format('Y-m-d');

        $attributes = [
            "kind"             => "vat",
            "number"           => null,
            "sell_date"        => $now,
            "issue_date"       => $now,
            "payment_to"       => $now,
            "seller_name"      => "IT&Business Training Mateusz Grabowski",
            'seller_street'    => 'ul. Zygmunta Starego 1/3',
            'seller_post_code' => '44-100',
            'seller_city'      => 'Gliwice',
            "seller_tax_no"    => "631-227-39-46",
            "buyer_name"       => $this->getClientName(),
            "buyer_email"      => $this->item->getEmail(),
            "buyer_tax_no"     => $this->getClientTaxId(),
            "positions"        => $this->getPositions(),
            'paid_date'        => $this->item->getSellDateFormatted(),
            'status'           => 'paid',
        ];

        return $attributes;
    }

    protected abstract function attachInvoiceToItem($invoiceId);

    protected abstract function getClientName() : string;

    protected abstract function getPositions() : array;

    protected abstract function getClientTaxId() : string;

    public function getDownloadUrl() : ?string
    {
        return $this->client->getInvoiceUrl($this->item->invoiceId());
    }
}