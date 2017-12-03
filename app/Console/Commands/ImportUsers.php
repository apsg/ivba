<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importuje użytkowników';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = fopen(base_path().'/users.csv' , 'r');

        while($data = fgetcsv($file, 1000, ',')){

            $email = $data[0];
            $name = $data[1];
            $status = $data[2];
            // try{
            //     $enddate = \Carbon\Carbon::parse($data[3]);
            // }catch(\Exception $ex){
            //     dd($data);
            // }
            $type = $data[4];

            $user = \App\User::firstOrCreate([
                    'email' => $email,
                ]);
            if($user) {
                $user->update([
                        'name'  => $name,
                    ]);

                if( $status == 'active' && $type == 2 ){
                    $enddate = \Carbon\Carbon::parse($data[3]);
                    $enddate = $enddate->addMonths(3);
                    $user->update([
                            'full_access_expires' => $enddate
                        ]);
                }
            }

        }
    }
}
