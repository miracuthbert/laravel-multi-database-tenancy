<?php

namespace App\Console;

use App\Console\Commands\Tenant\Migrate;
use App\Console\Commands\Tenant\MigrateRefresh;
use App\Console\Commands\Tenant\MigrateRollback;
use App\Console\Commands\Tenant\Seed;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Migrate::class,
        MigrateRollback::class,
        MigrateRefresh::class,
        Seed::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
