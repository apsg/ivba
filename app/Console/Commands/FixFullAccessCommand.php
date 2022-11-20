<?php
namespace App\Console\Commands;

use App\Events\FullAccessGrantedEvent;
use App\Repositories\AccessRepository;
use App\Repositories\UserRepository;
use Illuminate\Console\Command;

class FixFullAccessCommand extends Command
{
    protected $signature = 'orders:fix';

    public function handle(
        UserRepository $userRepository,
        AccessRepository $accessRepository
    ) {
        foreach ($this->emails() as $email) {

            $user = $userRepository->findByEmailOrCreate($email);

            if ($user->hasFullAccess()) {
                $this->info("User already has full access: {$email}");
                continue;
            }

            $accessRepository->grantFullAccess($user, 365);
            event(new FullAccessGrantedEvent($user));

            $this->info("Full access granted: {$email}");
        }
    }

    protected function emails(): array
    {
        return [
//            'e.iwanska@eveline.om.pl',
        ];
    }
}
