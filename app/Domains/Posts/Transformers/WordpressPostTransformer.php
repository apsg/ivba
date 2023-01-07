<?php
namespace App\Domains\Posts\Transformers;

use App\Domains\Posts\Models\PostDisplay;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use League\Fractal\TransformerAbstract;

class WordpressPostTransformer extends TransformerAbstract
{
    protected Collection $postDisplays;

    public function __construct(Collection $postDisplays)
    {
        $this->postDisplays = $postDisplays;
    }

    public function transform(array $wpPost): array
    {
        $id = Arr::get($wpPost, 'id');

        /** @var PostDisplay $display */
        $display = $this
            ->postDisplays
            ->where('post_id', $id)
            ->first();

        return $wpPost + [
                'displayed_at' => $display !== null ? $display->created_at : null,
            ];
    }
}
