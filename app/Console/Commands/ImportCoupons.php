<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportCoupons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:kupony';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importuje kody z pliku kupony.csv';

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
        $f = fopen(base_path().'/kupony.csv', 'r');

        while($data = fgetcsv($f)){
            \App\Coupon::create([
                    'code' => $data[0],
                    'type' => \App\Coupon::TYPE_VALUE,
                    'amount' => config('app.full_access_price'),
                    'uses_left' => 1
                ]);
        }
    }
}
