<?php 

namespace App\Helpers;

use Automattic\Wistia\Client;


/**
*  Uploader do Wistia
*/
class Wistia 
{
	
	public $client;

	protected $projectIDs = [
		'images' => 3023906,
		'videos' => 3023914,
		'files'	 => 3032448,
	];

	protected $projectPublicIds = [
		'images' => 'q0nogjugiu',
		'videos' => 'd9eimbepwo',
		'files'  => 'h784goz3ov',
	];

	protected $baseUrl = "https://izaurek.wistia.com/medias/";

	function __construct()
	{
		$this->client = new Client([
			'token' => '0263e648e30007b5a49643f3c6e14b6c45282609a34881b8cfe1d7816b0d4129'
		]);
	}

	/**
	 * Wyślij obraz do wistii i wrzuć do projektu iexcel_images
	 * @param  [type] $filePath [description]
	 * @return string           Pełny link do pliku
	 */
	public function uploadImage($filePath){
		$response = $this->client->create_media(
			$filePath,
			[
				'project_id' => $this->projectIDs['images'],
			]);

		$r2 = $this->client->show_media($response->hashed_id);

		return [ 
			'url' => $r2->assets[0]->url, 
			'hash' => $response->hashed_id
			];
	}

	/**
	 * Wyślij wideo do wistii do projektu iexcel_videos
	 * @param  [type] $filePath [description]
	 * @return [type]           [description]
	 */
	public function uploadVideo($filePath, $name){
		$response = $this->client->create_media(
			$filePath,
			[
				'project_id' => $this->projectIDs['videos'],
			]);

		$r2 = $this->client->show_media($response->hashed_id);

		return [
			'url' => $r2->assets[0]->url, 
			'hash' => $response->hashed_id,
			'thumb' => $r2->thumbnail->url,
            'embed' => $r2->embedCode ?? null,
            'filename' => $r2->name,
		];
	}

	/**
	 * Wyślij plik do projektu iexcel_files
	 * @param  [type] $filePath [description]
	 * @return [type]           [description]
	 */
	public function uploadFile( $filePath ){

		$response = $this->client->create_media(
			$filePath,
			[
				'project_id' => $this->projectIDs['files'],
			]);

		$r2 = $this->client->show_media($response->hashed_id);

		return [
			'url' => $r2->assets[0]->url, 
			'hash' => $response->hashed_id
			];
	}

	/**
	 * Listuj szczegóły projektu iexcel_images
	 * @return [type] [description]
	 */
	public function showImages(){
		return $this->client->show_project($this->projectPublicIds['images']);
	}

	/**
	 * Listuj szczegóły projektu iexcel_videos
	 * @return [type] [description]
	 */
	public function showVideos(){
		return $this->client->show_project($this->projectPublicIds['videos']);
	}

	/**
	 * Usuń wszystkie obrazy z projektu iexcel_images
	 * @return [type] [description]
	 */
	public function clearImages(){
		$images = $this->showImages();

		foreach($images->medias as $image){
			$this->client->delete_media( $image->hashed_id );
		}
	}

	/**
	 * Usuń wszystkie obrazy z projektu iexcel_images
	 * @return [type] [description]
	 */
	public function clearVideos(){
		$Videos = $this->showVideos();

		foreach($Videos->medias as $video){
			$this->client->delete_media( $video->hashed_id );
		}
	}

}