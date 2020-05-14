<?php
namespace App\Http\Controllers;

use App\Helpers\GateHelper;
use App\InvoiceRequest;
use App\Payment;
use Gate;

class PaymentsController extends Controller
{
    public function requestInvoice(Payment $payment)
    {
        if (!$payment->isConfirmed()) {
            flash('Ta płatność nie została potwierdzona, nie możemy wystawić dla niej faktury.');

            return back();
        }

        if (Gate::denies(GateHelper::REQUEST_INVOICE)) {
            flash('Proszę uzupełnić dane do faktury');

            return redirect(url('/account'))
                ->withErrors(['Proszę uzupełnić dane do faktury']);
        }

        if ($payment->invoice_request !== null) {
            flash('Już wygenerowano wcześniej prośbę o fakturę dla tego zamówienia.');

            return back()->withErrors(['Prośba już istnieje']);
        }

        InvoiceRequest::create([
            'invoicable_id'   => $payment->id,
            'invoicable_type' => Payment::class,
        ]);

        return back();
    }
}
