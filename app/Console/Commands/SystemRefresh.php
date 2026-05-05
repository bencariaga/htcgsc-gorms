<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;

class SystemRefresh extends BaseCommand
{
    protected $signature = 'system:refresh';

    public function handle(): int
    {
        $this->components->info('Refreshing the system...');

        if (!$this->components->confirm('This will wipe your database. Are you sure?', true)) {
            return Command::FAILURE;
        }

        $this->call('setup');

        $this->components->info('System refresh completed successfully!');

        return Command::SUCCESS;
    }
}
