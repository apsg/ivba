<?php

namespace App\Console\Commands;

use App\Helpers\Wistia;
use Illuminate\Console\Command;

class DiscoverAllVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:videos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importuj wszystkie znalezione w bazie wideo';

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
        $videos = $w->showVideos();

        foreach ($videos->medias as $video) {
            $img = $w->client->show_media($video->hashed_id);

            \App\Video::firstOrCreate([
                    'url'  => $img->assets[0]->url,
                    'hash' => $video->hashed_id,
                    'thumb' => $img->thumbnail->url,
                    'embed' => $img->embedCode,
                    'filename' => $img->name,
                ]);
        }
    }
}
