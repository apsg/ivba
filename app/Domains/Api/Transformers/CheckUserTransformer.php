<?php
namespace App\Domains\Api\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class CheckUserTransformer extends TransformerAbstract
{
    public function transform(User $user): array
    {
        return [
            'email'           => $user->email,
            'has_full_access' => $user->hasFullAccess(),
        ];
    }
}
