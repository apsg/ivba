<?php
namespace App;

use App\Mail\StandardEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

/**
 * App\Email.
 *
 * @property int                  $id
 * @property string               $from
 * @property int                  $to_id
 * @property string               $to_type
 * @property string               $title
 * @property string               $body
 * @property Carbon               $send_at
 * @property int                  $is_sent
 * @property int                  $type
 * @property string|null          $attachment
 * @property string|null          $unsubscribe_code
 * @property Carbon|null          $created_at
 * @property Carbon|null          $updated_at
 * @property int|null             $newsletter_id
 * @property Carbon|null          $opened_at
 * @property Carbon|null          $clicked_at
 * @property Carbon|null          $unsubscribed_at
 * @property-read Newsletter|null $newsletter
 * @property-read Model           $to
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
     * Do kogo możemy wysyłać? Użytkownik albo ktoś zapisany z newslettera.
     */
    public function to()
    {
        return $this->morphTo();
    }

    /**
     * Email może należeć do newslettera.
     */
    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    /**
     * Zaplanowane emaile.
     */
    public function scopePlanned($query)
    {
        $query->where('send_at', '>', Carbon::now());
    }

    /**
     * Emaile, którym minął termin wysyłki, lecz jeszcze nie zostały wysłane.
     */
    public function scopeDue($query)
    {
        $query->where('send_at', '<=', Carbon::now())
            ->where('is_sent', 'false');
    }

    public function send(): ?Email
    {
        if ($this->to === null) {
            $this->delete();

            return null;
        }

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
     * Dodaj do linków kod śledzenia kliknięć.
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
