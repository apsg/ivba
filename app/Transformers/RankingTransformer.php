<?php
namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class RankingTransformer extends TransformerAbstract
{
    /** @var User */
    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function transform($item)
    {
        return [
            'position' => $item->position,
            'name'     => $this->obfuscate($item),
            'points'   => $item->points,
            'is_me'    => $this->isMe($item->user_id),
        ];
    }

    protected function obfuscate($item) : string
    {
        if ($this->isMe($item->user_id)) {
            return $item->name;
        }

        return substr($item->name, 0, 3) . str_repeat('*', rand(1, 10));
    }

    protected function isMe(int $id) : bool
    {
        if ($this->user === null) {
            return false;
        }

        return $id === $this->user->id;
    }
}