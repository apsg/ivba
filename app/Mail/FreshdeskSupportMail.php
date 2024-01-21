<?php

namespace App\Mail;

use App\Course;
use App\Lesson;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FreshdeskSupportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $body;

    /**
     * @var Course|null
     */
    public $course;

    /**
     * @var Lesson|null
     */
    public $lesson;

    /** @var string|null  */
    public $phone;

    public function __construct(User $user, string $message, Course $course = null, Lesson $lesson = null, string $phone = null)
    {
        $this->user = $user;
        $this->body = $message;
        $this->course = $course;
        $this->lesson = $lesson;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.question')
            ->to(config('services.freshdesk.email'), 'Freshdesk Support')
            ->subject('Pytanie z serwisu ' . config('app.name'))
            ->replyTo($this->user->email);
    }
}
