<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reset hasła')
            ->greeting('Cześć!')
            ->line('Z tej strony Mateusz z ' . config('app.name'))
            ->line('Ze względów bezpieczeństwa lub na Twoje życzenie uruchomiona została procedura resetu hasła. '
                . 'Jeśli dopiero co utworzono Twoje konto, dzięki poniższemu linkowi możesz ustawić swoje hasło. '
                . 'Aby je zresetować kliknij w poniższy link:')
            ->action('Zresetuj hasło', url(config('app.url') . route('password.reset', $this->token, false)))
            ->line('Ta wiadomość została wygenerowana automatycznie po migracji Twojego konta do nowego systemu.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
