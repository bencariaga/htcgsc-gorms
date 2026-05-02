<?php

namespace App\Console;

use Illuminate\{Console\Scheduling\Schedule, Foundation\Console\Kernel as ConsoleKernel, Support\Facades\Http};

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('internet:check')->everyMinute()->runInBackground();

        $schedule->call(function () {
            Http::get(config('app.url'));
        })->everyFifteenMinutes();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
