<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReturnMailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                    ->subject('Wróć do nas')
                    ->greeting('Hej!')
                    ->line('Z tej strony Mateusz z Iexcel.pl')
                    ->line('Zmodernizowaliśmy się! Ponad 200 lekcji! Łatwiejszy dostęp! Więcej ćwiczeń!')
                    ->line('Chciałbym abyś wrócił na mój portal... wiem, podnieśliśmy cenę na 79zł brutto (ale to tylko 40 groszy za jedną lekcję!). Tu możesz zobaczyć kompletny spis lekcji w PDF http://blog.iexcel.pl/wp-content/uploads/2017/09/zawartosc_platformy.pdf')
                    ->line('Jeżeli zdecydujesz się do końca tygodnia, to roczna reaktywacja konta to tylko 29zł brutto! ')
                    ->line('1. Wejdź i zmień swoje hasło')
                    ->line('2. Wejdź na http://iexcel.pl/buy_access (lub kliknij w poniższy przycisk) i wpisz w koszyku kod WRACAM, który obniży cenę do 29 zł brutto.')
                    ->line('3. Udanej nauki!')
                    ->action('Kup pełen dostęp', url('/buy_access'));
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
