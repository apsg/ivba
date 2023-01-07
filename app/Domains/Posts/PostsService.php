<?php
namespace App\Domains\Posts;

use App\Domains\Admin\Helpers\SettingsHelper;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class PostsService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function getSourceUrl(): string
    {
        return trim(setting(SettingsHelper::POSTS_SOURCE), '/')
            . '/wp-json/wp/v2/posts';
    }

    public function fetch()
    {
        return json_decode($this
            ->client
            ->get($this->getSourceUrl() . '?_embed')
            ->getBody()
            ->getContents(), true);
    }

    public function getDisplaysForUser(User $user): Collection
    {
        return $user->post_displays;
    }

    public function getPostBySlug(string $slug): array
    {
        return Arr::get(json_decode($this
            ->client
            ->get($this->getSourceUrl() . '?_embed&slug=' . $slug)
            ->getBody()
            ->getContents()
            , true), '0', []);
    }
}
