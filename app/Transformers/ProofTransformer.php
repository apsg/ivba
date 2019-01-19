<?php
namespace App\Transformers;

use App\Proof;
use League\Fractal\TransformerAbstract;

class ProofTransformer extends TransformerAbstract
{
    public function transform(Proof $proof = null)
    {
        if ($proof === null) {
            return [];
        }

        return [
            'url'        => $proof->url,
            'name'       => $proof->name,
            'city'       => $proof->city,
            'body'       => $proof->body,
            'created_at' => $proof->created_at->diffForHumans(),
        ];
    }
}