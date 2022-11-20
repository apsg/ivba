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
            'urszula_wieladek@onet.pl',
            'kate@wa.onet.pl',
            'monika.polinska@vp.pl',
            'kama.bobrowska@gmail.com',
            'sylwiasz6@vp.pl',
            '09jagodadolecka@wp.pl',
            'joanna.slowiow@gmail.com',
            'perkozinski@gmail.com',
            'anna.pupko@onet.pl',
            'sandrakasprzak@wp.pl',
            'serjana17@gmail.com',
            'karolinaboryn3@gmail.com',
            'klaudia.fronczynska@gmail.com',
            'p.mocna24@gmail.com',
            'monika.blazejczyk@hotmail.com',
            'barbara.majka@op.pl',
            'iwonaurbanska70@gmail.com',
            'hubcia@vp.pl',
            'mirkalatek@o2.pl',
            'aleksandrachrupcala@gmail.com',
            'agapa11@wp.pl',
            'nina.niinna@gmail.com',
            'aleksandra.podebska@gmail.com',
            'mariapilat0@op.pl',
            'aannaa0@wp.pl',
            'tyna1998.98@gmail.com',
            'aleksandra160.b@gmail.com',
            'starlight@gazeta.pl',
            'monikaakopczynska@gmail.com',
            'aleksandra.podebska@gmail.com',
            'RAFAL@BIUROSKRA.PL',
            'malgorzata.kobus1@gmail.com',
            'olga.chenakal@gmail.com',
            'aleksandrachrupcala@gmail.com',
            'nina.lulewicz@gmail.com',
            'imblizej.tymdalej@gmail.com',
            'annakosmala532@gmail.com',
            'mcmatus73@gmail.com',
            'aannaa0@wp.pl',
            'aleksandra160.b@gmail.com',
            'magdallena88@gmail.com',
            'agapa11@wp.pl',
            'gdasauto@gmail.com',
            'tomek_lewandowski@wp.pl',
            'beatalubonska@interia.pl',
            'kamildonald@wp.pl',
            'lesmari@wp.pl',
            'dorota.kierner@gmail.com',
            'k.j.palka@mail.com',
            'izabelamichalkiewicz91@gmail.com',
            'mariusz200@poczta.onet.pl',
            'malgorzata.zywczak@op.pl',
            'monika.polinska@vp.pl',
            'przemyslawbartecki1905@gmail.com',
            'k.jaroszkiewicz@o2.pl',
            'agnieszka.markiewicz12@wp.pl',
            'agakasia@op.pl',
            'annawitak22@gmail.com',
            'elawaga470@gmail.com',
            'mariuszwieczorek3352119@gmail.com',
            'pl4400@outlook.com',
            'jlb090370@gmail.com',
            'easytofit@gmail.com',
            'kalinowska80@gmail.com',
            'beata_szlagor@yahoo.pl',
            'julitapawlak@gmail.com',
            'justicz@wp.pl',
            'alexandra.zochowska@gmail.com',
            'a.kidon91@gmail.com',
            'joanna.gankoo@gmail.com',
            'iza.kasprzak@gmail.com',
            'zaanka@poczta.onet.pl',
            'tomasz@atmpoland.pl',
            'kraczkowska.klaudia@gmail.com',
            'iwonajoanna11@gmail.com',
            'agnieszka_bielska@interia.pl',
            'katarzyna.kotecka.us@interia.pl',
            'lukasznowakowski17@gmail.com',
            'jacekbugaj@gmail.com',
            'gaude@go2.pl',
            'szwaj.sylwia@gmail.com',
        ];
    }
}
