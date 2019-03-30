<?php

namespace App;

use Carbon\CarbonInterval;
use DateInterval;
use Illuminate\Database\Eloquent\Model;

/**
 * App\FollowupContent
 *
 * @property int $id
 * @property string $event
 * @property string $delay
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Followup[] $followups
 * @property-read mixed $interval
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereDelay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FollowupContent extends Model
{
    protected $guarded = [];

    /**
     * Zwraca zaplanowane followupy
     * @return [type] [description]
     */
    public function followups()
    {
        return $this->hasMany(Followup::class);
    }

    /**
     * Zwraca różnicę czasu jako obiekt DateInterval
     */
    public function getIntervalAttribute()
    {
        return CarbonInterval::instance(new DateInterval($this->delay));
    }

    /**
     * Link Edycji tego elementu
     * @return [type] [description]
     */
    public function editLink()
    {
        return url('/admin/followups/' . $this->id);
    }


    /**
     * Link do usuwania elementu
     * @return [type] [description]
     */
    public function deleteLink()
    {
        return url('/admin/followups/' . $this->id . '/delete');
    }

    /**
     * Link do wysyłki testowej
     * @return [type] [description]
     */
    public function testLink()
    {
        return url('/admin/followups/' . $this->id . '/test');
    }

}
