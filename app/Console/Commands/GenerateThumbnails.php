<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:thumb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wygeneruj miniatury';

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
        $images = \App\Image::all();

        $images->each->makeThumb(200, 200);
        $images->each->makeThumb(189, 209);
        $images->each->makeThumb(360, 240);
    }
}
