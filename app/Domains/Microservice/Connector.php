<?php
namespace App\Domains\Microservice;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Connector
{
    const HEADER_NAME = 'X-INAUKA-KEY';

    public function verifyHeader(Request $request): bool
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

    public function course(string $provider, int $courseId)
    {
        $client = new Client();
        $baseUrl = config("connector.providers.{$provider}");

        return json_decode($client->get("{$baseUrl}/api/courses/{$courseId}", [
            'headers' => ['X-INAUKA-KEY' => config('connector.key')],
        ])->getBody()->getContents(), true);
    }
}
