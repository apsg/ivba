<?php

namespace App\Helpers;

use Vimeo;

class VimeoHelper{
	
	/**
	 * Wysyła wideo na vimeo i zwraca dane do stworzenia obiektu Video
	 * @param  [type] $filePath [description]
	 * @param  [type] $name     [description]
	 * @return [type]           [description]
	 */
	public static function uploadVideo( $filePath, $name, $title = null ){

		$uri = Vimeo::upload( $filePath );

		Vimeo::request($uri, [
			'name'	=> $title
		], 'PATCH');

		$data = Vimeo::request( $uri );

		return [
			'url' => $data['body']['link'], 
			'hash' => str_replace('/videos/', '', $uri),
			'thumb' => '',
            'embed' => $data['body']['embed']['html'],
            'filename' => $name,
		];
	}

	/**
	 * Dla podanej szerokości zwraca typowe rozmiary miniatur z Vimeo
	 * @param  [type] $width [description]
	 * @return [type]        [description]
	 */
	public static function getThumbSize( $width ){
		if($width <= 100){
			return [100, 75];
		}

		if($width <= 200){
			return [200, 150];
		}

		if($width <= 295){
			return [295, 166];
		}

		if($width <= 640 ){
			return [640, 360];
		}

		if($width <= 960 ){
			return [960, 540];
		}

		return [ 1920, 1080 ];
	}

	/**
	 * [getThumb description]
	 * @param  [type] $videoId [description]
	 * @return [type]          [description]
	 */
	public static function getThumb( $videoId ){
		
		$data = Vimeo::request('/videos/'.$videoId);

		$picturesUri = $data['body']['pictures']['uri'];
		$picturesUri = explode('/', $picturesUri);
		return end( $picturesUri );

	}

}