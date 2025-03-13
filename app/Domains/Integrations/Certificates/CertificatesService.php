<?php
namespace App\Domains\Integrations\Certificates;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cache;
use JsonException;

class CertificatesService
{
    const HEADER_NAME = 'X-CERTIFICATES-KEY';
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(string $email)
    {
        return Cache::remember(
            static::HEADER_NAME . $email,
            now()->addMinutes(5),
            function () use ($email) {
                try {
                    $result = $this->client->get(config('connector.certificates.url') . '/api/certificates',
                        [
                            'query'   => [
                                'email' => $email,
                            ],
                            'headers' => [
                                static::HEADER_NAME => config('connector.certificates.key'),
                            ],
                        ]);

                    return json_decode($result->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
                } catch (ClientException|JsonException $exception) {
                    return [];
                }
            });
    }
}
