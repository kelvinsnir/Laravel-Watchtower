<?php

namespace Watchtower\Commands;

use Illuminate\Console\Command;
use Watchtower\Checks\LogCheck;

class CheckLogs extends Command
{
    protected $signature = 'watchtower:logs';
    protected $description = 'Check Laravel logs for new errors';

    public function handle(LogCheck $check)
    {
        $check->run();
        $this->info('Watchtower log check completed.');
        return self::SUCCESS;
    }
}
