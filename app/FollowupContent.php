<?php

namespace App;

use Carbon\CarbonInterval;
use DateInterval;
use Illuminate\Database\Eloquent\Model;

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
