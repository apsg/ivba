<?php
namespace App;

use Carbon\Carbon;

/**
 * App\ItemImage.
 *
 * @property int         $id
 * @property string      $title
 * @property int         $image_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Image  $image
 */
class ItemImage extends Item
{
    public $view = 'admin.partials.item_image';
    public $type = 'image';

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
