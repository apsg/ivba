<?php
namespace Gacek\IExcel;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

abstract class BaseIExcelService
{
    /** @var string */
    protected $token;

    /** @var string */
    protected $url;

    /** @var Client */
    protected $client;

    public function __construct(string $token = null)
    {
        $this->token = $token;
        $this->client = new Client();
    }

    public function send($data, string $method = 'POST')
    {
        try {
            $response = $this->client->request(
                $method,
                $this->url,
                [
                    'form_params' => array_merge([
                        'source' => config('iexcel.source'),
                    ], $data),
                ]
            );

            return [
                'status' => $response->getStatusCode(),
                'body'   => $response->getBody()->getContents(),
            ];
        } catch (ClientException $exception) {
            return [];
        } catch (ConnectException $exception) {
            return [];
        }
    }
}