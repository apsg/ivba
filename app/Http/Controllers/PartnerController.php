<?php

namespace App\Http\Controllers;

class PartnerController extends Controller
{
    public function index($partner)
    {
        $cookie = cookie()->forever('partner_id', $partner);

        return redirect('/')->withCookie($cookie);
    }
}
