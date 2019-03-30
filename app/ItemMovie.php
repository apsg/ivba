<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ItemMovie
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $video_id
 * @property-read \App\Video $video
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereVideoId($value)
 * @mixin \Eloquent
 */
class ItemMovie extends Item
{
	public $view = 'admin.partials.item_movie';	
    
    /**
     * Obiekt wideo związany z tym elementem
     * @return [type] [description]
     */
	public function video(){
		return $this->belongsTo(\App\Video::class);
	}

}
