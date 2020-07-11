<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderConfirmed extends Notification
{
    use Queueable;

    /** @var Order */
    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
            ->subject('Twoje zamówienie zostało potwierdzone')
            ->greeting('Cześć!')
            ->line('Otrzymaliśmy potwierdzenie Twojego zamówienia w systemie ' . config('app.name'))
            ->line('Zamówienie numer ' . $this->order->id . ' z dnia ' . $this->order->updated_at
                . ' zostało potwierdzone, a dostępy aktywowane.')
            ->line('Opis zamówienia: ' . $this->order->description)
            ->line('Od teraz zakupione dostępy lub abonamenty są aktywne. '
                . 'Możesz sprawdzić swoje dostępy na swoim profilu:')
            ->action('Zaloguj się do swojego profilu', url('/account'))
            ->line('Życzymy miłej nauki!');
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
