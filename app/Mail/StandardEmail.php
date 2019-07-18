<?php
namespace App\Mail;

use App\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StandardEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->email = $email;

//        if ($email->from) {
//            $this->from($email->from);
//        }

        $this->subject = $email->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->markdown('mails.default')
            ->subject($this->email->title);

        if ($this->email->attachment) {
            $mail = $mail->attach(storage_path('app/' . $this->email->attachment));
        }

        return $mail;
    }
}
