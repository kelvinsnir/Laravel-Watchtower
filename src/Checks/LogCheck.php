<?php

namespace Watchtower\Checks;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Watchtower\Notifications\LogAlert;

class LogCheck
{
    public function run(): void
    {
        $logPath = storage_path('logs/laravel.log');

        if (!file_exists($logPath)) {
            return;
        }

        $lastSize = Cache::get('watchtower.log_size', 0);
        $currentSize = filesize($logPath);

        if ($currentSize <= $lastSize) {
            return;
        }

        $newLogs = file_get_contents(
            $logPath,
            false,
            null,
            $lastSize
        );

        Cache::put('watchtower.log_size', $currentSize);

        if (str_contains($newLogs, 'ERROR') || str_contains($newLogs, 'CRITICAL')) {
            Notification::route('mail', config('mail.from.address'))
                ->notify(new LogAlert($newLogs));
        }
    }
}
