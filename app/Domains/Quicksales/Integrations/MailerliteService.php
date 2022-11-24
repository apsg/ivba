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

    public function getGroups()
    {
        return Cache::remember('mailerlite_groups', static::CACHE_REMEMBER_MINUTES, function () {
            return $this->getGroupsRawLoop();
        });
    }

    public function getGroupsRawLoop(): array
    {
        $results = [];
        $offset = 0;
        $shouldRepeat = true;

        while ($shouldRepeat === true) {
            $items = $this
                ->sdk
                ->groups()
                ->limit(100)
                ->offset($offset)
                ->get();

            array_push($results, ...$items->toArray());
            $offset += 100;
            $shouldRepeat = $items->count() === 100;
        }

        return $results;
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
