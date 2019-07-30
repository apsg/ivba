<?php
namespace App;

use Carbon\Carbon;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Followup[] $followups
 * @property-read mixed $interval
 * @method static FollowupContent newModelQuery()
 * @method static FollowupContent newQuery()
 * @method static FollowupContent query()
 * @method static FollowupContent whereAttachment($value)
 * @method static FollowupContent whereBody($value)
 * @method static FollowupContent whereCreatedAt($value)
 * @method static FollowupContent whereDelay($value)
 * @method static FollowupContent whereEvent($value)
 * @method static FollowupContent whereId($value)
 * @method static FollowupContent whereSlug($value)
 * @method static FollowupContent whereTitle($value)
 * @method static FollowupContent whereUpdatedAt($value)
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
