<?php

namespace App;

use App\Mail\StandardEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Mail;

/**
 * App\Email
 *
 * @property int $id
 * @property string $from
 * @property int $to_id
 * @property string $to_type
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon $send_at
 * @property int $is_sent
 * @property int $type
 * @property string|null $attachment
 * @property string|null $unsubscribe_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $newsletter_id
 * @property \Illuminate\Support\Carbon|null $opened_at
 * @property \Illuminate\Support\Carbon|null $clicked_at
 * @property \Illuminate\Support\Carbon|null $unsubscribed_at
 * @property-read \App\Newsletter|null $newsletter
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $to
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email due()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email planned()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereClickedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereIsSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereNewsletterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereOpenedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereToType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUnsubscribeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUnsubscribedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Email extends Model
{

    const NEWSLETTER = 1;
    const FOLLOWUP = 2;
    const SINGLE = 3;

    protected $guarded = [];

    protected $casts = [
        'send_at'         => 'datetime',
        'opened_at'       => 'datetime',
        'clicked_at'      => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Do kogo możemy wysyłać? Użytkownik albo ktoś zapisany z newslettera
     * @return [type] [description]
     */
    public function to()
    {
        return $this->morphTo();
    }

    /**
     * Email może należeć do newslettera
     * @return [type] [description]
     */
    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    /**
     * Zaplanowane emaile.
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopePlanned($query)
    {
        $query->where('send_at', '>', Carbon::now());
    }

    /**
     * Emaile, którym minął termin wysyłki, lecz jeszcze nie zostały wysłane
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeDue($query)
    {
        $query->where('send_at', '<=', Carbon::now())
            ->where('is_sent', 'false');
    }

    /**
     * Wyślij email.
     */
    public function send()
    {
        $this->convertLinks();

        try {
            Mail::to($this->to->email)
                ->send(new StandardEmail($this));

            $this->update(['is_sent' => true]);
        } catch (\Swift_TransportException $exception) {
            $this->delete();
        }

        return $this;
    }

    /**
     * Dodaj do linków kod śledzenia kliknięć
     * @return [type] [description]
     */
    protected function convertLinks()
    {

        $pattern = '/href="[a-zA-Z\d:\/\.]+/i';
        $replace = '${0}?eid=' . $this->id;

        $this->update([
            'body' => preg_replace($pattern, $replace, $this->body),
        ]);
    }

}
