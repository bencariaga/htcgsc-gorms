<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;

class LogsClear extends BaseCommand
{
    protected $signature = 'logs:clear';

    public function handle(): int
    {
        if (!$this->components->confirm('Are you sure you want to clear all the log files?', false)) {
            $this->components->info('Log deletion operation cancelled.');

            return 0;
        }

        $logPath = storage_path('logs');

        $files = File::glob("{$logPath}/*.log");

        if (blank($files)) {
            $this->components->info('No log files found.');

            return 0;
        }

        foreach ($files as $file) {
            File::delete($file);
        }

        $this->components->info('Log deletion operation completed successfully.');

        return 0;
    }
}
