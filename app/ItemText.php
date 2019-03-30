<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ItemText
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemText extends Item
{
	public $view = 'admin.partials.item_text';	
    
}
