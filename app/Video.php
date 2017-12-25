<?php

namespace App;

use Vimeo;
use App\Helpers\VimeoHelper;
use App\Helpers\Wistia;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public static function boot(){
        parent::boot();

        /**
         * Usuń fizyczny plik związany z tym filmem
         */
        static::deleting(function($model){
            // $wistia = new Wistia;
            // $wistia->client->delete_media( $model->hash );
            
            Vimeo::request('/videos/'.$model->hash, [], 'DELETE' );

        });
    }

    /**
     * Zwróć link do miniatury o podanych wymiarach
     * @param  integer $width  szerokość
     * @param  integer $height wysokość
     * @return [string]          url do pliku
     */
    // public function thumb( $width = 200, $height = 200, $second = 1 ){
    // 	return str_replace('.bin', '.jpg', $this->url).'?video_still_time='.$second.'&image_crop_resized='.$width.'x'.$height;
    // }
    public function thumb( $width = 200, $height = 200 ){

        if(empty($this->thumb)){
            $this->getThumbId();
        }

        $size = VimeoHelper::getThumbSize($width);

        return 'https://i.vimeocdn.com/video/'
            .$this->thumb.'_'.implode('x', $size)
            .'.jpg?r=pad';

    }

    /**
     * Pobierz na nowo id dla miniatur
     * @return [type] [description]
     */
    public function getThumbId(){
        $this->thumb = VimeoHelper::getThumb( $this->hash );
        $this->save();
    }

    /**
     * Wyślij nowy plik
     * @param  [type] $path [description]
     * @return [type]       [description]
     */
    public static function upload( $filePath, $filename, $title = null ){
        return self::create( \App\Helpers\VimeoHelper::uploadVideo($filePath, $filename, $title) );
    }

    /**
     * Wygeneruj kod do zagnieżdżania filmu
     * @param  integer $width  [description]
     * @param  integer $height [description]
     * @return [type]          [description]
     */
    public function embed( $width = 400, $height = 300 ){

        return str_replace([
                'width="400"',
                'height="300"'
            ], [
                'width="'.$width.'"',
                'height="'.$height.'"'
            ], $this->embed);
    }

}
