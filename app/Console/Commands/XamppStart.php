<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Process;

class XamppStart extends BaseCommand
{
    protected $signature = 'xampp:start';

    public function handle()
    {
        if ($this->areServicesRunning()) {
            $this->components->info('XAMPP services (Apache and MySQL) are already running.');

            return;
        }

        $this->components->info('Starting XAMPP services...');

        if (PHP_OS_FAMILY !== 'Windows') {
            $this->startOnNonWindows();

            return;
        }

        $this->startOnWindows();

        $this->components->info('XAMPP start commands have been dispatched.');
    }

    protected function startOnWindows(): void
    {
        $this->components->bulletList(['Starting Apache...', 'Starting MySQL...']);

        Process::run('powershell.exe -Command "Start-Process \'C:\xampp\apache\bin\httpd.exe\'"');
        Process::run('powershell.exe -Command "Start-Process \'C:\xampp\mysql\bin\mysqld.exe\'"');
    }

    protected function startOnNonWindows(): void
    {
        $this->components->warn('Non-Windows OS detected. Attempting to start XAMPP via /opt/lampp/lampp...');
        Process::run('sudo /opt/lampp/lampp start');
    }

    protected function areServicesRunning(): bool
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $apache = Process::run('powershell.exe -Command "Get-Process httpd -ErrorAction SilentlyContinue"')->successful();
            $mysql = Process::run('powershell.exe -Command "Get-Process mysqld -ErrorAction SilentlyContinue"')->successful();

            return $apache && $mysql;
        }

        return false;
    }
}
