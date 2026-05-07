<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\{File, Process};
use Symfony\Component\Console\Command\Command;

class PestControl extends BaseCommand
{
    protected $signature = 'system:pest-control';

    public function handle(): int
    {
        $this->components->info('Starting Pest Control (Security & Logic Audit)...');

        $this->checkVulnerabilities();
        $this->checkOutdatedPackages();
        $this->scanBladeFiles();
        $this->checkControllerAuthorization();

        $this->components->info('Pest Control completed!');

        return Command::SUCCESS;
    }

    private function checkVulnerabilities(): void
    {
        $this->components->task('Checking for vulnerable dependencies (composer audit)', function () {
            $result = Process::run('composer audit');

            if ($result->failed()) {
                $this->newLine();
                $this->components->warn($result->output());

                return false;
            }

            return true;
        });
    }

    private function checkOutdatedPackages(): void
    {
        $this->components->task('Checking for outdated packages', function () {
            $result = Process::run('composer outdated --direct');

            if ($result->successful() && !empty(trim($result->output()))) {
                $this->newLine();
                $this->info($result->output());
            }

            return true;
        });
    }

    private function scanBladeFiles(): void
    {
        $this->components->task('Scanning Blade files for unescaped output ({!! ... !!})', function () {
            $files = File::allFiles(resource_path('views'));
            $found = false;

            foreach ($files as $file) {
                if ($file->getExtension() === 'php' && str($file->getContents())->contains('{!!')) {
                    $this->components->warn("Unescaped output found in: {$file->getRelativePathname()}");
                    $found = true;
                }
            }

            return !$found;
        });
    }

    private function checkControllerAuthorization(): void
    {
        $this->components->task('Checking controllers for authorization gates', function () {
            $files = File::allFiles(app_path('Http/Controllers'));
            $missing = false;

            foreach ($files as $file) {
                if ($file->getFilename() === 'Controller.php') {
                    continue;
                }

                $content = $file->getContents();

                if (str($content)->doesntContain(['authorize(', 'Gate::', 'can:'])) {
                    $this->components->warn("Potential missing authorization in: {$file->getRelativePathname()}");
                    $missing = true;
                }
            }

            return !$missing;
        });
    }
}
