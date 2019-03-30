<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Script
 *
 * @property int $id
 * @property string $title
 * @property string $script
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereScript($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Script extends Model
{
    protected $guarded = [];
}
