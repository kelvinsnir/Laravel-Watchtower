<?php

namespace Watchtower\Checks;

use Illuminate\Support\Facades\Notification;
use Watchtower\Notifications\QueueAlert;

class QueueCheck
{
    public function run(): void
    {
        $command = 'supervisorctl status';

        $output = shell_exec($command);

        if (!$output) {
            Notification::route('mail', config('mail.from.address'))
                ->notify(new QueueAlert('Supervisor not responding'));
            return;
        }

        if (
            str_contains($output, 'STOPPED') ||
            str_contains($output, 'EXITED') ||
            str_contains($output, 'FATAL')
        ) {
            Notification::route('mail', config('mail.from.address'))
                ->notify(new QueueAlert($output));
        }
    }
}
