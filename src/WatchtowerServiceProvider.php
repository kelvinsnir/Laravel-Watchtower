<?php

namespace Watchtower;

use Illuminate\Support\ServiceProvider;
use Watchtower\Commands\InstallCommand;
use Watchtower\Commands\CheckLogs;
use Watchtower\Commands\CheckQueues;

class WatchtowerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }


    public function boot()
    {
        //public config
         $this->publishes([
        __DIR__.'/../config/watchtower.php' => config_path('watchtower.php'),
    ], 'watchtower-config');

        //register artisan command
         if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                CheckLogs::class,
                CheckQueues::class,
            ]);
        }
    }
}
