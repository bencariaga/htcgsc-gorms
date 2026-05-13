<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Process;

class XamppEnd extends BaseCommand
{
    protected $signature = 'xampp:end {--skip-repair}';

    public function handle()
    {
        $this->components->info('Stopping XAMPP services...');

        if (PHP_OS_FAMILY !== 'Windows') {
            $this->stopOnNonWindows();

            return;
        }

        $this->stopOnWindows();

        $this->components->info('XAMPP stop commands have been executed.');

        if (!$this->option('skip-repair')) {
            $this->components->info('Initiating automated repair...');
            $this->call('xampp:repair', ['--no-restart' => true, '--no-interaction' => true]);
        }
    }

    protected function stopOnWindows(): void
    {
        $this->components->bulletList(['Stopping httpd.exe...', 'Stopping mysqld.exe...']);

        Process::run('powershell.exe -Command "taskkill /f /im httpd.exe"');
        Process::run('powershell.exe -Command "taskkill /f /im mysqld.exe"');
    }

    protected function stopOnNonWindows(): void
    {
        $this->components->warn('Non-Windows OS detected. Attempting to stop XAMPP via /opt/lampp/lampp...');

        Process::run('sudo /opt/lampp/lampp stop');
    }
}
