<?php

namespace Watchtower\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class QueueAlert extends Notification
{
    public function __construct(
        protected string $message
    ) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('🚨 Queue Worker Issue')
            ->line('A queue worker problem was detected.')
            ->line($this->message);
    }
}
