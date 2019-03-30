<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ItemFile
 *
 * @property int $id
 * @property string $title
 * @property string $path
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $hash
 * @property int $host
 * @property string|null $size
 * @property string $name
 * @property string $mime
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
