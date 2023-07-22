<?php
namespace App\Domains\Integrations\Cloudflare;

class Cloudflare
{
    public function __construct()
    {
        $this->accountId = config('cloudflare.account_id');
        $this->subdomain = config('cloudflare.subdomain');
        $this->apikey = config('cloudflare.apikey');
    }

    public function thumb(string $videoId): string
    {
        return $this->subdomain
            . '/' . $videoId
            . '/thumbnails/thumbnail.jpg';
    }

    public function import(string $videoId, string $title = ''): array
    {
        return [
            'thumb'          => $this->thumb($videoId),
            'cloudflare_uid' => $videoId,
            'filename'       => $title,
        ];
    }
}
