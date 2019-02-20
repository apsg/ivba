<?php

namespace App;

use App\Mail\StandardEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Mail;

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
