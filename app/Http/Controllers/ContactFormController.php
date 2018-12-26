<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Mail;

class ContactFormController extends Controller
{
    public function send(Request $request)
    {
        $this->validate($request, [
            'name'                 => 'required',
            'email'                => 'required',
            'message'              => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        Mail::to("szymon.gackowski@gmail.com")
            ->send(new ContactFormMail($request->email, $request->name, $request->message));

        return ['ok'];
    }
}
