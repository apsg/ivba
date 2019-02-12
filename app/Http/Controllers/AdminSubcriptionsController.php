<?php

namespace App\Http\Controllers;

use App\Subscription;

class AdminSubcriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function cancel(Subscription $subscription)
    {
        $subscription->cancel();

        flash('Anulowano subskrypcję');

        return back();
    }
}
