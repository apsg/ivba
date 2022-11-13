<?php
namespace App\Domains\Posts\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int       id
 * @property integer   post_id
 * @property integer   user_id
 * @property Carbon    created_at
 * @property Carbon    updated_at
 *
 * @property-read User user
 * @property-read Post post
 */
class PostDisplay extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
