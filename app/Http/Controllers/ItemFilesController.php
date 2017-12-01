<?php

namespace App\Http\Controllers;

use App\ItemFile;
use Illuminate\Http\Request;

class ItemFilesController extends Controller
{
    
	/**
	 * Rozpocznij pobieranie pliku
	 * @param  ItemFile $file [description]
	 * @return [type]         [description]
	 */
	public function download(ItemFile $file){
		
		// Z Wistii
		if($file->host == 1){
			return response()->make( 
				file_get_contents($file->path), 
				200, [
					"Content-Type" => $file->mime,
					"Content-Length" => $file->size,
					"Content-disposition" => "attachment; filename=\"".$file->name."\""
				] );
		}

		// lokalny storage
		return response()->download( storage_path($file->path), $file->name );
	}

}
