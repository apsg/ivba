<?php
namespace App\Domains\Posts\Models;

use App\Image;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property int                         id
 * @property string                      title
 * @property string                      slug
 * @property string                      excerpt
 * @property string                      body
 * @property Carbon|null                 published_at
 * @property int                         image_id
 * @property Carbon                      created_at
 * @property Carbon                      updated_at
 *
 * @property-read Collection|PostDisplay displays
 *
 * @method static Builder published()
 * @method static Builder withDisplays(User $user)
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

    protected $dates = [
        'published_at',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function displays(): HasMany
    {
        return $this->hasMany(PostDisplay::class);
    }

    public function scopePublished(Builder $builder)
    {
        return $builder->whereNotNull('published_at');
    }

    public function scopeWithDisplays(Builder $builder, User $user)
    {
        $builder->selectSub(
            PostDisplay::select('created_at')
                ->where('user_id', $user->id)
                ->whereColumn('post_id', 'posts.id')
                ->take(1),
            'displayed_at'
        );
    }
}
