<?php
namespace App\Domains\Api\Transformers;

use League\Fractal\TransformerAbstract;

class ItemTransformer extends TransformerAbstract
{
    public function transform($item): array
    {
        return $item->toArray();
    }
}
