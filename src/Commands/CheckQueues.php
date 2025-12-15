<?php

namespace Watchtower\Commands;

use Illuminate\Console\Command;
use Watchtower\Checks\QueueCheck;

class CheckQueues extends Command
{
    protected $signature = 'watchtower:queues';
    protected $description = 'Check Supervisor queue workers';

    public function handle(QueueCheck $check)
    {
        $check->run();
        $this->info('Watchtower queue check completed.');
        return self::SUCCESS;
    }
}
