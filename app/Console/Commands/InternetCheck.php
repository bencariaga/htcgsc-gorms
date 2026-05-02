<?php

namespace App\Console\Commands;

use Illuminate\Support\{Carbon, Facades\Http, Facades\Log, Number};
use Throwable;

class InternetCheck extends BaseCommand
{
    protected $signature = 'internet:check';

    public function handle()
    {
        $startTime = Carbon::now();

        try {
            $response = Http::timeout(5)->get('https://8.8.8.8');

            if ($response->successful()) {
                $duration = $startTime->diffInMilliseconds(Carbon::now(), true);
                $formattedDuration = Number::format($duration, precision: 0);

                $this->components->info('Online! Internet connection detected.');
                $this->newLine();
                $this->components->info("Ping: {$formattedDuration} milliseconds.");

                return 0;
            }
        } catch (Throwable $e) {
            Log::error("Internet check failed: {$e->getMessage()}");
        }

        $this->components->warn('Offline! No internet connection detected.');

        return 1;
    }
}
