<?php
namespace App\Http\Controllers;

use App\InvoiceRequest;
use App\Payment;
use App\User;

class PaymentsController extends Controller
{
    public function requestInvoice(Payment $payment)
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->first_name === null || $user->last_name === null || $user->taxid === null) {
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
