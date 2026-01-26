<?php
namespace App\Domains\Api\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class GenericModelTransformer extends TransformerAbstract
{
    public function transform(Model $model = null): array
    {
        if ($model === null) {
            return [];
        }

        return $model->toArray();
    }
}
