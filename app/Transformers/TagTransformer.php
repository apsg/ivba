<?php

namespace App\Transformers;

use App\Domains\Courses\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $tag): array
    {
        return [
            'id'        => $tag->id,
            'name'      => $tag->name,
            'color'     => $tag->color,
            'is_hidden' => $tag->is_hidden,
        ];
    }
}
