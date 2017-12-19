<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;

class ContactFormController extends Controller
{
    
	/**
	 * Wyślij maila z formularza kontaktowego
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function send(Request $request){

    	$this->validate($request, [
    		'name'		=> 'required',
    		'email'		=> 'required',
    		'message'	=> 'required',
    	]);

    	\Mail::to( 'szymon.gackowski@gmail.com' )
    		->send( new ContactFormMail($request->email, $request->name, $request->message ) );

    	return ['ok'];
    }
}
