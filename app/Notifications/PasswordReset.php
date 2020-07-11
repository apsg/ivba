<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    public $token;

    /** @var bool */
    public $isFresh;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, bool $isFresh = false)
    {
        $this->token = $token;
        $this->isFresh = $isFresh;
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
        if ($this->isFresh) {
            return (new MailMessage)
                ->subject('Ustaw hasło')
                ->greeting('Cześć!')
                ->line('Z tej strony Mateusz z ' . config('app.name'))
                ->line('Założyliśmy Ci konto na naszym portalu! Będziesz tam miał dostęp do zakupionych kursów. '
                    . 'Aby móc z niego w pełni korzystać musisz ustawić sobie hasło. '
                    . 'Aby to zrobić kliknij w poniższy link:')
                ->action('Ustaw hasło', url(config('app.url')
                    . route('password.reset', ['token' => $this->token], false)))
                ->line('Możesz też w swoim panelu zarządzania kontem dodać dane do faktury:')
                ->line('Zobacz swoje dane: ' . url('/account'));
        }

        return (new MailMessage)
            ->subject('Reset hasła')
            ->greeting('Cześć!')
            ->line('Z tej strony Mateusz z ' . config('app.name'))
            ->line('Ze względów bezpieczeństwa lub na Twoje życzenie uruchomiona została procedura resetu hasła. '
                . 'Jeśli dopiero co utworzono Twoje konto, dzięki poniższemu linkowi możesz ustawić swoje hasło. '
                . 'Aby je zresetować kliknij w poniższy link:')
            ->action('Zresetuj hasło',
                url(config('app.url') . route('password.reset', ['token' => $this->token], false)));
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
