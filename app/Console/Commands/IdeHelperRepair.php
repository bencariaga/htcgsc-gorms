<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;

class IdeHelperRepair extends BaseCommand
{
    protected $signature = 'ide-helper:repair';

    public function handle()
    {
        $helperPath = base_path('vendor/_laravel_ide/_model_helpers.php');

        if (File::exists($helperPath)) {
            File::delete($helperPath);
        }

        $this->call('ide-helper:generate');

        $this->call('ide-helper:models', ['--nowrite' => true]);

        $this->components->info('IDE Helper files have been repaired successfully.');
    }
}
