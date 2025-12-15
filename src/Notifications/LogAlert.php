<?php

namespace Watchtower\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LogAlert extends Notification
{
    use Queueable;

    public function __construct(
        protected string $logs
    ) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('🚨 Laravel Error Detected')
            ->line('New error detected in Laravel logs.')
            ->line(substr($this->logs, 0, 1000));
    }
}
