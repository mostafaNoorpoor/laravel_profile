<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage ;

class InvoiceChat extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $message ;

    public function __construct($message)
    {
        $this->message = $message ;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database' , 'mail' , 'slack'];
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
                    ->line('The introduction to the notification.')
                    ->subject('Invoice chat')
                    ->from('admin@gmail.com','support')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    public function toSlack($notifiable)
    {
//        return (new SlackMessage)
//            ->from('Laravel')
//            ->to('#general')
//            ->image('https://laravel.com/favicon.png')
//            ->content('This will display the Laravel logo next to the message');
//
        return (new SlackMessage)
            ->success()
            ->image('https://laravel.com/favicon.png')
            ->content($this->message);
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
            'data' => 'this is my first notification'
        ];
    }
}
