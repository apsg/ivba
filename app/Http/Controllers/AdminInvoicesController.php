<?php

namespace App\Http\Controllers;

use App\InvoiceRequest;

class AdminInvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $invoices = InvoiceRequest::whereNull('refused_at')
            ->orderBy('created_at')
            ->get();

        return view('admin.invoices.index')->with(compact('invoices'));
    }

    public function accept(InvoiceRequest $invoiceRequest)
    {
        $invoiceRequest->confirm();

        flash('Zaakceptowano pomyślnie');

        return back();
    }

    public function reject(InvoiceRequest $invoiceRequest)
    {
        $invoiceRequest->reject();

        flash('Żądanie odrzucone');

        return back();
    }
}
