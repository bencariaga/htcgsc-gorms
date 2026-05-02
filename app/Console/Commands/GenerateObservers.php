<?php

namespace App\Console\Commands;

use FilesystemIterator;
use Illuminate\Support\Facades\Artisan;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class GenerateObservers extends BaseCommand
{
    protected $signature = 'observers:generate';

    public function handle(): void
    {
        $excluded = $this->excludedModels();
        $modelDir = app_path('Models');

        if (!is_dir($modelDir)) {
            return;
        }

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($modelDir, FilesystemIterator::SKIP_DOTS));

        foreach ($iterator as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $modelClass = $this->resolveModelClass($file->getPathname());

            if (!class_exists($modelClass)) {
                continue;
            }

            $modelName = class_basename($modelClass);

            if ($this->isExcluded($modelName, $modelClass, $excluded)) {
                $this->line("Skipped: {$modelClass}");

                continue;
            }

            $this->createObserverIfMissing($modelName, $modelClass);
        }
    }

    protected function createObserverIfMissing(string $modelName, string $modelClass): void
    {
        $observerPath = app_path("Observers/{$modelName}Observer.php");

        if (file_exists($observerPath)) {
            $this->line("Observer already exists for {$modelClass}");

            return;
        }

        Artisan::call('make:observer', ['name' => "{$modelName}Observer", '--model' => $modelClass]);

        $this->components->info("Observer created for {$modelClass}");
    }

    protected function excludedModels(): array
    {
        return [];
    }

    protected function resolveModelClass(string $path): string
    {
        return str($path)->replace(app_path(), 'App')->replace(['/', '\\'], '\\')->replace('.php', '')->toString();
    }

    protected function isExcluded(string $name, string $class, array $excluded): bool
    {
        return collect([$name, $class])->intersect($excluded)->isNotEmpty();
    }
}
