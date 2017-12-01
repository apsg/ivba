<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
        return (new MailMessage)
            ->subject('Reset hasła')
            ->greeting('Cześć!')
            ->line('Z tej strony Mateusz z iExcel.pl
Właśnie modyfikujemy nasz system do nauki Excela - będzie
więcej lekcji :)')
            ->line('Przenosimy wszystko! Jednak ze wzglęgu bezpieczeństwa
nie mamy dostępu do Twojego hasła!')
            ->line('Prosimy zrestartuj je.')
            ->action('Zresetuj hasło', url(config('app.url') . route('password.reset', $this->token, false)))
            ->line('Ta wiadomość została wygenerowana automatycznie po migracji Twojego konta do nowego systemu.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
