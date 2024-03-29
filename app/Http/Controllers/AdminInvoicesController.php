<?php
namespace App\Http\Controllers;

use App\InvoiceRequest;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;

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

    public function edit(InvoiceRequest $invoiceRequest)
    {
        return view('admin.invoices.edit')->with(compact('invoiceRequest'));
    }

    public function update(InvoiceRequest $invoiceRequest, Request $request)
    {
        $invoiceRequest->update([
                                    'custom_description' => $request->input('custom_description'),
                                ]);

        $invoiceRequest->user()->update($request->only('company_name', 'address', 'taxid'));

        if ($invoiceRequest->invoicable instanceof Order) {
            $invoiceRequest->invoicable->update([
                                                    'final_total' => $request->input('final_total'),
                                                ]);
        }

        if ($invoiceRequest->invoicable instanceof Payment) {
            $invoiceRequest->invoicable->update([
                                                    'amount' => $request->input('amount'),
                                                ]);
        }

        flash('Zaktualizowano pomyślnie');

        return redirect(route('admin.invoice.index'));
    }
}
