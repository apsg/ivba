<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Point.
 *
 * @property int            user_id
 * @property int            points
 * @property Carbon         created_at
 * @property Carbon         updated_at
 * @property-read User      user
 * @mixin \Eloquent
 */
class Point extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
