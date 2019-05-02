<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RandomPasswordGenerated extends Notification
{
    use Queueable;

    public $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
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
                    ->subject('Wygenerowano nowe hasło w systemie iExcel.pl')
                    ->greeting('Cześć!')
                    ->line('Wygenerowano dla Ciebie nowe hasło w systemie iExcel.pl. Pamiętaj, by zmienić to hasło zaraz po zalogowaniu.')
                    ->line('Twoje nowe hasło:')
                    ->line($this->password)
                    ->action('Zaloguj się na inauka.pl', url('/login'))
                    ->line('Dziękujemy za używanie inauka.pl');
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
