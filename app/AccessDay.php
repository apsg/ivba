<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AccessDay
 * @package App
 *
 * @property int       user_id
 * @property Carbon    date
 *
 * @property-read User user
 *
 * @method Builder|AccessDay current()
 * @method Builder|AccessDay past()
 *
 */
class AccessDay extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Uzytkownik
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Scope: dzisiaj
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeCurrent($query)
    {
        $query->where('date', \Carbon\Carbon::now()->format('Y-m-d'));
    }

    /**
     * Scope: Poprzednie dni
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopePast($query)
    {
        $query->where('date', '<=', \Carbon\Carbon::now()->format('Y-m-d'));
    }

}
