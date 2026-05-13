<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;

class XamppRepair extends BaseCommand
{
    protected $signature = 'xampp:repair {--no-restart}';

    public function handle()
    {
        $this->components->warn('This operation will delete specific files in C:\xampp\mysql\data and restore them from the backup folder.');

        if (!$this->option('no-interaction') && !$this->confirm('Do you want to proceed? This is a destructive operation for your local MySQL system files.', false)) {
            $this->components->info('Repair process aborted.');

            return;
        }

        $this->components->info('Step 1: Stopping XAMPP services...');
        $this->call('xampp:end', ['--skip-repair' => true]);

        $dataPath = 'C:\xampp\mysql\data';
        $backupPath = 'C:\xampp\mysql\backup';

        if (!File::isDirectory($dataPath) || !File::isDirectory($backupPath)) {
            $this->components->error('XAMPP MySQL directories not found. Please ensure XAMPP is installed at C:\xampp.');

            return;
        }

        $this->components->info('Step 2: Deleting corrupted/system files...');
        $targetsToDelete = config('mysql.files');
        $protected = config('mysql.protected', []);

        foreach ($targetsToDelete as $target) {
            if (collect($protected)->contains($target)) {
                $this->components->warn("Skipping protected target: {$target}");

                continue;
            }

            $fullPath = str($dataPath)->finish('/')->append(str($target)->replace('\\', '/'))->replace('\\', '/');

            if (File::isDirectory($fullPath)) {
                File::deleteDirectory($fullPath);
                $this->components->bulletList(["Removed directory: {$target}"]);

                continue;
            }

            if (File::exists($fullPath)) {
                File::delete($fullPath);
                $this->components->bulletList(["Removed file: {$target}"]);
            }
        }

        $this->components->info('Step 3: Restoring files from backup...');

        foreach ($targetsToDelete as $target) {
            if (collect($protected)->contains($target)) {
                continue;
            }

            $targetPath = str($target)->replace('\\', '/');
            [$source, $destination] = collect([$backupPath, $dataPath])->map(fn ($path) => str($path)->finish('/')->append($targetPath)->replace('\\', '/'))->all();

            if (File::isDirectory($source)) {
                File::copyDirectory($source, $destination);
                $this->components->bulletList(["Restored directory: {$target}"]);

                continue;
            }

            if (File::exists($source)) {
                File::copy($source, $destination);
                $this->components->bulletList(["Restored file: {$target}"]);
            }
        }

        if (!$this->option('no-restart')) {
            $this->components->info('Step 4: Restarting services...');
            $this->call('xampp:start');
        }

        $this->components->info('XAMPP MySQL repair process completed.');
    }
}
