<?php
namespace App\Interfaces;

use App\User;

interface InvoicableContract
{
    public function hasInvoice() : bool;

    public function invoiceDownloadUrl() : ?string;

    public function invoiceId() : ?int;

    public function getSellDateFormatted() : string;

    public function getEmail() : string;

    public function getUser() : User;
}
