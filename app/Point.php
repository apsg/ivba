<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Point
 *
 * @package App
 * @property int            user_id
 * @property int            points
 * @property Carbon         created_at
 * @property Carbon         updated_at
 * @property-read User      user
 * @mixin \Eloquent
 */
class Point extends Model
{
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
