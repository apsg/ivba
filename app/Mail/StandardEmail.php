<?php

namespace App\Mail;

use App\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StandardEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Email $email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if( empty($this->email->attachment) ){
            return $this->view('mails.default')
                ->subject($this->email->title);
        }else{
            return $this->view('mails.default')
                ->subject($this->email->title)
                ->attach( storage_path( 'app/'.$this->email->attachment ) );
        }
    }
}
