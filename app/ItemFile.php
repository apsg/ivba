<?php
namespace App;

use Carbon\Carbon;

/**
 * App\ItemFile.
 *
 * @property int         $id
 * @property string      $title
 * @property string      $path
 * @property string      $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $hash
 * @property int         $host
 * @property string|null $size
 * @property string      $name
 * @property string      $mime
 */
class ItemFile extends Item
{
    public $view = 'admin.partials.item_file';
    public $type = 'file';

    /**
     * Zwraca link do pobierania zasobu.
     */
    public function link()
    {
        return url('itemfile/' . $this->id);
    }

    /**
     * Zwraca klasę ikony dla tego pliku.
     */
    public function icon()
    {
        switch ($this->type) {
            case 'txt':
            case 'odt':
            {
                return 'fa-file-text-o';
            }

            case 'doc':
            case 'docx':
            {
                return 'fa-file-word-o';
            }

            case 'zip':
            case 'rar':
            case 'gz':
            {
                return 'fa-file-zip-o';
            }

            case 'ods':
            case 'xls':
            case 'xlsx':
            case 'csv':
            {
                return 'fa-file-excel-o';
            }
            default:
            {
                return 'fa-file-o';
            }
        }
    }
}
