<?php

namespace App\Http\Controllers;

use App\Email;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class EmailsController extends Controller
{
    /**
     * Wypisz użytkownika z otrzymywania wiadomości tego typu.
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function unsubscribe($code)
    {
        $email = Email::where('unsubscribe_code', $code)->first();

        if (empty($code) || ! $email) {
            flash('Podany kod wypisania się jest nieprawidłowy');

            return redirect('/');
        }

        if ($email->to) {
            $email->to->unsubscribe();
            $email->update([
                'unsubscribed_at' => Carbon::now(),
            ]);
        }

        return redirect('/');
    }

    /**
     * Zwraca jednopikselowy obrazek, który oznacza określony email jako otwarty.
     * @param  Email $email [description]
     * @return [type]        [description]
     */
    public function getOpenedImg(Email $email)
    {
        if (is_null($email->opened_at)) {
            $email->update([
                'opened_at' => Carbon::now(),
            ]);
        }

        return Image::make(storage_path('app/1px.png'))->response();
    }
}
