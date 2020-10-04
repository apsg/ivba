<?php
namespace App\Domains\Quicksales\Transformers;

use League\Fractal\TransformerAbstract;

class BaselinkerProductsTranformer extends TransformerAbstract
{
    public function transform($product)
    {
        return [
            'id'   => $product->product_id,
            'name' => $product->name,
        ];
    }
}