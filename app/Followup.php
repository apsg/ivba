<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Followup
 *
 * @property int $id
 * @property int $followup_content_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $send_at
 * @property int $is_sent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\FollowupContent $followupContent
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereFollowupContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereIsSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereUserId($value)
 * @mixin \Eloquent
 */
class Followup extends Model
{
    protected $guarded = [];

    protected $casts = [
        'send_at' => 'datetime',
    ];

    public function followupContent()
    {
        return $this->belongsTo(FollowupContent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function send()
    {
        if ($this->user !== null) {
            $this->user->emails()->create([
                'from'             => config('mail.from.address'),
                'title'            => $this->followupContent->title,
                'body'             => $this->followupContent->body,
                'send_at'          => $this->send_at,
                'type'             => 2,
                'unsubscribe_code' => uniqid(),
                'attachment'       => $this->followupContent->attachment,
            ]);
        }

        $this->is_sent = true;
        $this->save();
    }
}
