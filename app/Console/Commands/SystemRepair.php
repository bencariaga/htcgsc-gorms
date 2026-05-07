<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Command\Command;

class SystemRepair extends BaseCommand
{
    protected $signature = 'system:repair';

    public function handle(): int
    {
        $this->components->info('Starting system repair...');

        $this->components->task('Clearing all application caches', fn () => Artisan::call('optimize:clear') === 0);

        if (blank(config('app.key'))) {
            $this->components->warn('APP_KEY is missing. Generating a new one...');
            $this->call('key:generate', ['--force' => true]);
        }

        $this->components->task('Verifying environment files', function () {
            return $this->callSilent('env:check') === 0;
        });

        $this->components->task('Cleaning up temporary files', function () {
            Artisan::call('debugbar:clear');
            Artisan::call('livewire:clear');

            return true;
        });

        $this->components->info('System repair completed successfully!');

        return Command::SUCCESS;
    }
}
