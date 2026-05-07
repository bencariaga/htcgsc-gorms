<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;

class Setup extends BaseCommand
{
    protected $signature = 'setup';

    public function handle(): int
    {
        $this->components->info('Setting up the system.');
        $this->components->task('Clearing system cache', fn () => $this->callSilent('optimize:clear') === 0);
        $this->components->task('Wiping database and dropping views', fn () => $this->callSilent('db:wipe', ['--force' => true, '--drop-views' => true]) === 0);
        $this->components->task('Running Laravel core migrations', fn () => $this->callSilent('migrate', ['--path' => 'database/migrations/laravel', '--ansi' => true, '--force' => true]) === 0);
        $this->components->info('Running system migrations in sequence...');

        $migrationFiles = glob(database_path('migrations/system/*.php'));

        sort($migrationFiles);

        $this->withProgressBar($migrationFiles, function ($file) {
            $path = str((string) $file)->after(base_path())->trim('/\\')->replace('\\', '/')->toString();
            $this->callSilent('migrate', ['--path' => $path, '--ansi' => true, '--force' => true]);
        });

        $this->newLine(2);

        $this->components->task('Seeding database', fn () => $this->callSilent('db:seed', ['--ansi' => true, '--force' => true]) === 0);
        $this->components->task('Linking storage', fn () => $this->callSilent('storage:link') === 0);

        $this->newLine();

        $this->components->info('System setup has been completed successfully!');

        return Command::SUCCESS;
    }
}
