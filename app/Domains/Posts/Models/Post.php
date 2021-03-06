<?php
namespace App\Domains\Posts\Models;

use App\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property int         id
 * @property string      title
 * @property string      slug
 * @property string      excerpt
 * @property string      body
 * @property Carbon|null published_at
 * @property int         image_id
 * @property Carbon      created_at
 * @property Carbon      updated_at
 */
class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'published_at',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function image() : BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
