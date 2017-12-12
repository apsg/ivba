<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderConfirmed extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
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
                    ->subject('Twoje zamówienie zostało potwierdzone')
                    ->greeting('Cześć!')
                    ->line('Otrzymaliśmy potwierdzenie Twojego zamówienia w systemie iVBA.pl.')
                    ->line('Zamówienie numer '.$this->order->id.' z dnia '.$this->order->created_at.' zostało potwierdzone, a dostępy aktywowane.')
                    ->line('Od teraz możesz korzystać z zakupionych dostępów, aby to zrobić, zaloguj się w naszym systemie. Możesz też sprawdzić swoje dostępy na swoim profilu:')
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
