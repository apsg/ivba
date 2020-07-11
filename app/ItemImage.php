<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ItemImage.
 *
 * @property int $id
 * @property string $title
 * @property int $image_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Image $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemImage extends Item
{
    public $view = 'admin.partials.item_image';

    /**
     * Obraz przypięty do tego widoku.
     * @return [type] [description]
     */
    public function image()
    {
        return $this->belongsTo(\App\Image::class);
    }
}
