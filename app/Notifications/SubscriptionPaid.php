<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionPaid extends Notification
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
            ->subject('Przedłużono abonament w ' .config('app.name') )
            ->greeting('Cześć!')
            ->line('Przedłużyliśmy Twój dostęp do '.config('app.name').' o kolejne '.$this->subscription->duration.' dni w ramach wykupionego przez Ciebie abonamentu.' )
            ->line('Obciążyliśmy Twoją kartę na kwotę: '.$this->subscription->amount .' PLN')
            ->line('Następna płatność zostanie wykonana dnia: '.$this->subscription->next_payment_at->format('Y-m-d'))
            ->line('Aby sprawdzić swoje dostępy, aktualny abonamen i inne dane, przejdź do swojego profilu:')
            ->action('Zaloguj się do swojego profilu', url('/account'))
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
