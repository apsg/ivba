<?php

namespace App\Helpers;

use Oktawave_OCS_OCSClient;

class Oktawave{
	
	public $client;

	public function __construct( $bucket = 'iexcel_filmy' ){
		$this->client = new Oktawave_OCS_OCSClient($bucket);
		$this->client->authenticate('MateuszGrabowski10420:admin', 'Insekt1!');
	}

	public function test(){
		dd($this->client->listObjects());
	}

	public function upload($path){
		$path = $this->client->uploadObject($path);
	}

}