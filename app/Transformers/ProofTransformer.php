<?php
namespace App\Transformers;

use App\Proof;
use Carbon\Carbon;
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
            'name'       => $this->gdpr($proof->name),
            'city'       => $proof->city,
            'body'       => $proof->body,
            'created_at' => $this->date($proof->created_at),
        ];
    }

    protected function date(Carbon $date = null)
    {
        if ($date === null) {
            return null;
        }

        if ($date->diffInDays() > 14) {
            return null;
        }

        return $date->diffForHumans();
    }

    protected function gdpr(string $name) : string
    {
        return str_split($name, 4)[0]
            . str_repeat('*', max(0, strlen($name) - 4));
    }
}