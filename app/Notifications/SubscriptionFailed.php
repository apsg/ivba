<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionFailed extends Notification
{
    use Queueable;

    public $subscription;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Subscription $subscription)
    {
        $this->subscription = $subscription;
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
            ->subject('Abonament w ' . config('app.name') . ' anulowany')
            ->greeting('Cześć!')
            ->line('Twój abonament na platformie ' . config('app.name') . ' został anulowany. Nastąpiło to na Twoje życzenie lub automatycznie, w wyniku niepowodzenia płatności za kolejny okres rozliczeniowy.')
            ->line('W ramach nadal aktywnych dostępów możesz korzystać z systemu jeszcze przez ' . $this->subscription->user->remaining_days . ' dni')
            ->line('Jeśli chcesz dalej korzystać z naszego systemu, wystarczy że klikniesz w poniższy link i w dowolnym momencie wykupisz abonament lub dostęp. Twój postęp nauki zostanie zachowany.')
            ->action('Przedłuż dostęp', url('/buy_access'))
            ->line('Życzymy miłej nauki!');
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
