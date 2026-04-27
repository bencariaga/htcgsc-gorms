<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;

class Setup extends BaseCommand
{
    protected $signature = 'setup';

    public function handle(): int
    {
        $this->components->info('Setting up the system.');

        $this->components->task('Wiping database and dropping views', fn () => $this->callSilent('db:wipe', ['--force' => true, '--drop-views' => true]));

        $this->components->task('Running system migrations', fn () => $this->callSilent('migrate', ['--path' => 'database/migrations/laravel', '--ansi' => true, '--force' => true]));

        $tables = ['persons', 'students', 'users', 'referrers', 'referrals', 'appointments', 'reports', 'all_activities'];

        $migrations = collect($tables)->map(fn ($table) => "database/migrations/system/create_{$table}_" . ($table === 'all_activities' ? 'view' : 'table') . '.php')->all();

        $this->newLine();

        $this->withProgressBar($migrations, fn ($path) => $this->callSilent('migrate', ['--path' => $path, '--ansi' => true, '--force' => true]));

        $this->newLine(2);

        $this->components->task('Seeding database....', fn () => $this->callSilent('db:seed', ['--ansi' => true, '--force' => true]) === 0);

        $this->newLine();

        $this->components->info('System setup has been completed successfully!');

        return Command::SUCCESS;
    }
}
