<?php
namespace App\Domains\Quicksales\Integrations;

use App\User;
use Illuminate\Support\Facades\Cache;
use MailerLiteApi\MailerLite;

class MailerliteService
{
    const CACHE_REMEMBER_MINUTES = 5;

    /**
     * @var MailerLite
     */
    protected $sdk;

    public function __construct()
    {
        $this->sdk = new MailerLite(config('services.mailerlite.key'));
    }

    public function getGroups() : array
    {
        return Cache::remember('mailerlite_groups', static::CACHE_REMEMBER_MINUTES, function () {
            return $this
                ->sdk
                ->groups()
                ->get()
                ->toArray();
        });
    }

    public function addUserToGroup(User $user, string $groupId)
    {
        return $this
            ->sdk
            ->groups()
            ->addSubscriber($groupId, [
                'email'  => $user->email,
                'name'   => $user->full_name,
                'fields' => [
                    'phone' => $user->phone,
                ],
            ]);
    }
}
