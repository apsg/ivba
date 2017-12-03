<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

class ItemFile extends Item
{

	public $view = 'admin.partials.item_file';	
    
    /**
     * Zwraca link do pobierania zasobu
     * @return [type] [description]
     */
	public function link(){
		return url('itemfile/'.$this->id);
	}

	/**
	 * Zwraca klasę ikony dla tego pliku
	 * @return [type] [description]
	 */
	public function icon(){
		switch($this->type){
			case "txt":
			case "odt":{
				return 'fa-file-text-o';
			}

			case "doc":
			case "docx":{
				return "fa-file-word-o";
			}

			case "zip":
			case "rar":
			case "gz" :{
				return 'fa-file-zip-o';
			}

			case 'ods':
			case 'xls':
			case 'xlsx':
			case 'csv':{
				return 'fa-file-excel-o';
			}
			default:{
				return 'fa-file-o';
			}
		}
	}

}
