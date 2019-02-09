<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

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
        $this->user->emails()->create([
            'from'             => config('mail.from.address'),
            'title'            => $this->followupContent->title,
            'body'             => $this->followupContent->body,
            'send_at'          => $this->send_at,
            'type'             => 2,
            'unsubscribe_code' => uniqid(),
            'attachment'       => $this->followupContent->attachment,
        ]);

        $this->is_sent = true;
        $this->save();
    }
}
