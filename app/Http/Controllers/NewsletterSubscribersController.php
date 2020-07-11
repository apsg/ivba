<?php

namespace App\Http\Controllers;

use App\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscribersController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            ]);
        $name = null;
        $user = \App\User::where('email', $request->email)->first();
        if ($user) {
            $name = $user->name;
        }

        NewsletterSubscriber::add($request->email, $name);

        flash('Dodano email do listy subskrybentów newslettera.');

        return back();
    }
}
