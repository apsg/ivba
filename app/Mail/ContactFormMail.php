<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $email;
    public $name;

    /**
     * Create a new body instance.
     *
     * @return void
     */
    public function __construct($email, $name, $body)
    {
        $this->body = $body;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Build the body.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.contact_form')
            ->replyTo($this->email, $this->name)
            ->subject('Formularz kontaktowy ze strony inauka.pl');
    }
}
