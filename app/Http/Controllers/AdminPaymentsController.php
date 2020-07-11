<?php
namespace App\Http\Controllers;

use App\Payment;
use DataTables;
use Illuminate\Http\Request;

class AdminPaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.payments');
    }

    /**
     * Zwraca dane dla datatables.
     */
    public function getData(Request $request)
    {
        $payments = Payment::with('subscription.user');

        return DataTables::of($payments)
            ->addColumn('type', function (Payment $payment) {
                return $payment->is_recurrent ? 'Automatyczna' : 'Pierwsza';
            })
            ->addColumn('subscription', function (Payment $payment) {
                return $payment->subscription_id;
            })
            ->addColumn('user', function (Payment $payment) {
                return '#' . ($payment->subscription->user->id ?? null)
                    . ' | ' . ($payment->subscription->user->email ?? null);
            })
            ->addColumn('reason', function (Payment $payment) {
                return $payment->reason;
            })
            ->make(true);
    }
}
