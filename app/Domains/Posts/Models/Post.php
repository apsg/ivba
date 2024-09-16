<?php
namespace App\Domains\Posts\Models;

use App\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int             id
 * @property string          title
 * @property string          body
 * @property string|null     cta_url
 * @property int|null        image_id
 * @property Carbon|null     published_at
 * @property Carbon          created_at
 * @property Carbon          updated_at
 *
 * @property-read Image|null image
 */
class Post extends Model
{
    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
