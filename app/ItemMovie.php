<?php
namespace App;

use Carbon\Carbon;

/**
 * App\ItemMovie.
 *
 * @property int                             $id
 * @property string                          $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int                             $video_id
 * @property-read Video                      $video
 */
class ItemMovie extends Item
{
    public $view = 'admin.partials.item_movie';
    public $type = 'movie';

    /**
     * Obiekt wideo związany z tym elementem.
     * @return [type] [description]
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
