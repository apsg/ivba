<?php
namespace App\Domains\Microservice;

use Illuminate\Http\Request;

class Connector
{
    const HEADER_NAME = 'X-INAUKA-KEY';

    public function verifyHeader(Request $request) : bool
    {
        if (!$request->hasHeader(static::HEADER_NAME)) {
            return false;
        }

        if (empty($request->header(static::HEADER_NAME))) {
            return false;
        }

        if ($request->header(static::HEADER_NAME) === config('connector.key')) {
            return true;
        }

        return false;
    }
}
