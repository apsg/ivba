<?php
namespace App\Domains\Logbooks\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int               id
 * @property int               user_id
 * @property int               logbook_entry_id
 * @property string            comment
 * @property Carbon            created_at
 * @property Carbon            udpated_at
 *
 * @property-read User         user
 * @property-read LogbookEntry logbook_entry
 */
class LogbookComment extends Model
{
    protected $fillable = [
        'user_id',
        'logbook_entry_id',
        'comment',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logbook_entry() : BelongsTo
    {
        return $this->belongsTo(LogbookEntry::class);
    }
}
