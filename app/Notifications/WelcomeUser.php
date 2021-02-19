<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class WelcomeUser extends Notification implements ShouldQueue
{
    use Queueable;

    public string $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $password)
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
        $appName = config('app.name');

        return (new MailMessage)
            ->line("Welcome to {$appName}")
            ->line('You have been given access to our platform.')
            ->line(new HtmlString("Here is your password: <b>{$this->password}</b>"))
            ->action('Sign In', route('login'))
            ->line('Apply to the available programs immediately!');
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
