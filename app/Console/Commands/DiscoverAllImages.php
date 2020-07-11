<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DiscoverAllImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wczytaj do DB wszystkie obrazy znalezione na wistii';

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
        $w = new \App\Helpers\Wistia;
        $images = $w->showImages();

        foreach ($images->medias as $image) {
            $img = $w->client->show_media($image->hashed_id);

            \App\Image::firstOrCreate([
                    'url'  => $img->assets[0]->url,
                    'hash' => $image->hashed_id,
                ]);
        }
    }
}
