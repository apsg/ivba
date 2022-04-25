<?php
namespace App\Domains\Api\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccessGrantedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = route('account.mycourses');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('common.mails.accessgranted')
            ->subject('Przyznano Ci dostęp do kursu na platformie ' . config('app.name'));
    }
}
