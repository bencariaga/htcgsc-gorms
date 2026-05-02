<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;

class SystemOptimize extends BaseCommand
{
    protected $signature = 'system:optimize';

    public function handle()
    {
        $this->components->info('Starting system optimization and cache clearing.');

        $tasks = [
            'cached bootstrap' => fn () => Artisan::call('optimize:clear'),
            'Debugbar storage' => [DebugbarClear::class, 'clear'],
            'Livewire temporary' => [CleanLivewireTemp::class, 'clear'],
        ];

        foreach ($tasks as $label => $action) {
            $this->components->task("Clearing {$label} files", $action);
        }

        $this->components->info('System cache has been cleared successfully!');
    }
}
