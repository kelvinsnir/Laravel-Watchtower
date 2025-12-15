<?php

namespace Watchtower\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'watchtower:install';
    protected $description = 'Install and configure Watchtower';

    public function handle()
    {
        $this->info('🔭 Installing Watchtower...');

        $this->callSilent('vendor:publish', [
            '--tag' => 'watchtower-config',
            '--force' => false,
        ]);

        $this->info('✅ Config published: config/watchtower.php');

        $this->line('');
        $this->line('Next steps:');
        $this->line('1. Set WATCHTOWER_ALERT_EMAIL in .env');
        $this->line('2. Add scheduler to App\\Console\\Kernel');
        $this->line('3. Run php artisan watchtower:logs');
    }
}
