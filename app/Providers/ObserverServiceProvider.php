<?php

namespace App\Providers;

use App\{Contracts\AppointmentServiceContract, Services\ListType\AppointmentService, Support\Regex};
use Illuminate\Support\{Facades\File, Reflector, ServiceProvider};
use Symfony\Component\Finder\SplFileInfo;

/** @property mixed $app */
class ObserverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AppointmentServiceContract::class, AppointmentService::class);

        $actionsPath = app_path('Actions');

        if (!File::isDirectory($actionsPath)) {
            return;
        }

        foreach (File::directories($actionsPath) as $directory) {
            $this->bindActionsInDirectory($directory);
        }
    }

    public function boot(): void
    {
        $modelsPath = app_path('Models');

        if (!File::isDirectory($modelsPath)) {
            return;
        }

        foreach (File::files($modelsPath) as $file) {
            $this->registerObserverForModel($file);
        }
    }

    private function bindActionsInDirectory(string $directory): void
    {
        $folderName = basename($directory);

        foreach (File::files($directory) as $file) {
            $this->bindActionInterface($folderName, $file->getFilenameWithoutExtension());
        }
    }

    private function bindActionInterface(string $folderName, string $action): void
    {
        $plural = str($action)->replaceMatches(Regex::pluralizeAction(), 's', 1);

        $singular = str($plural)->replaceMatches(Regex::singularizeAction(), '', 1);

        $class = "App\\Actions\\{$folderName}\\{$singular}";

        $interface = "App\\Contracts\\{$plural}";

        if (!Reflector::isCallable($class) && !Reflector::isCallable($interface)) {
            $this->app->bind($interface, $class);
        }
    }

    private function registerObserverForModel(SplFileInfo $file): void
    {
        $modelName = $file->getFilenameWithoutExtension();

        $modelClass = "App\\Models\\{$modelName}";

        $observerClass = "App\\Observers\\{$modelName}Observer";

        if (!Reflector::isCallable($modelClass) && !Reflector::isCallable($observerClass)) {
            $modelClass::observe($observerClass);
        }
    }
}
