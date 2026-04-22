<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;

class Setup extends BaseCommand
{
    protected $signature = 'setup';

    public function handle(): int
    {
        $this->components->info('Setting up the system.');

        $this->call('key:generate', ['--ansi' => true]);

        $this->call('migrate', [
            '--path' => 'database/migrations/special/nuke_database.php',
            '--ansi' => true,
            '--force' => true,
        ]);

        $this->call('migrate', [
            '--drop-views' => true,
            '--path' => 'database/migrations/laravel',
            '--ansi' => true,
            '--force' => true,
        ]);

        $migrations = [
            'database/migrations/system/create_persons_table.php',
            'database/migrations/system/create_students_table.php',
            'database/migrations/system/create_users_table.php',
            'database/migrations/system/create_referrers_table.php',
            'database/migrations/system/create_referrals_table.php',
            'database/migrations/system/create_appointments_table.php',
            'database/migrations/system/create_reports_table.php',
            'database/migrations/special/add_auto_increment.php',
            'database/migrations/system/create_all_activities_view.php',
        ];

        foreach ($migrations as $path) {
            $this->call('migrate', [
                '--path' => $path,
                '--ansi' => true,
                '--force' => true,
            ]);
        }

        $this->call('db:seed', ['--ansi' => true, '--force' => true]);
        $this->call('storage:link', ['--ansi' => true]);
        $this->components->info('System setup has been completed successfully!');

        return Command::SUCCESS;
    }
}
