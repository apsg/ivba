<?php

namespace App;

// use App\Helpers\Wistia;
use ImageHelper;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [ 'url', 'hash' , 'filename'];

    public static function boot(){
    	parent::boot();

    	/**
    	 * Usuń fizyczny plik związany z tym obrazem
    	 */
    	static::deleting(function($model){
    		// $wistia = new Wistia;
    		// $wistia->delete_media( $model->hash );
            // TODO : usuwanie ze storage 
    	});
    }

    /**
     * Wyślij plik do wistii i zapisz dane w DB
     * @param  [type] $filePath [description]
     * @return [type]           Obiekt
     */
    public static function upload( $filePath ){
    	// $wistia = new Wistia;

    	// return self::create( $wistia->uploadImage( $filePath ) );
    }

    /**
     * Podaj URL do miniaturki o zadanym rozmiarze
     * @param  integer $width  [description]
     * @param  integer $height [description]
     * @return [type]          [description]
     */
    public function thumb( $width = 200, $height = 200 ){
    	// return str_replace(".bin", ".jpg", $this->url)."?image_crop_resized=".$width."x".$height;
        $filename = pathinfo( $this->path(), PATHINFO_FILENAME );
        $extension = pathinfo( $this->path(), PATHINFO_EXTENSION );

        $thumb = $filename.'_'.$width.'x'.$height.'.'.$extension;

        if( file_exists( storage_path('app/public/images/'.$thumb) ) ){
            return url('storage/images/'.$thumb);
        }else{
            return $this->makeThumb($width, $height);
        }

    }

    /**
     * Wygeneruj miniaturę o podanych wymiarach
     * @param  integer $width  [description]
     * @param  integer $height [description]
     * @return [type]          [description]
     */
    public function makeThumb( $width = 200, $height = 200 ){
        $filename = pathinfo( $this->path(), PATHINFO_FILENAME );
        $extension = pathinfo( $this->path(), PATHINFO_EXTENSION );
        $thumb = $filename.'_'.$width.'x'.$height.'.'.$extension;

        if(!file_exists( storage_path('app/public/images/'.$thumb) )){
            $img = ImageHelper::make( $this->path() );


            $img->fit( $width, $height );
            $img->save( storage_path('app/public/images/'.$thumb) );
        }
        return url( 'storage/images/'.$thumb );
    }

    /**
     * Ścieżka do pliku
     * @return [type] [description]
     */
    public function path(){
        return storage_path('app/public/images/'.$this->filename);
    }

}
