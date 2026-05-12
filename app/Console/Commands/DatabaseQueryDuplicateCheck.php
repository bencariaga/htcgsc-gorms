<?php

namespace App\Console\Commands;

use Illuminate\Support\{Facades\DB, Reflector};

class DatabaseQueryDuplicateCheck extends BaseCommand
{
    protected $signature = 'dbqdupe:check {id=1} {--m|model=Person} {--persons} {--users} {--students} {--referrers} {--referrals} {--appointments} {--reports}';

    protected $description = 'Verify if request-level caching is preventing duplicate queries for models.';

    public function handle()
    {
        DB::enableQueryLog();

        $id = $this->argument('id');
        $modelClass = $this->resolveModel();

        if (!$modelClass) {
            return 1;
        }

        $className = class_basename($modelClass);
        $primaryKey = (new $modelClass)->getKeyName();

        $this->components->info("Testing caching mechanism for {$className} [ID: {$id}]");

        $this->components->task('Fetching via find() (1st time)', function () use ($modelClass, $id) {
            $instance = $modelClass::find($id);

            return (bool) $instance;
        });

        $this->components->task('Fetching via find() (2nd time - should be cached)', function () use ($modelClass, $id) {
            $modelClass::find($id);
        });

        $this->components->task("Fetching via where('{$primaryKey}', {$id})->first() (should be cached)", function () use ($modelClass, $primaryKey, $id) {
            $modelClass::where($primaryKey, $id)->first();
        });

        $queries = DB::getQueryLog();
        $totalQueries = collect($queries)->count();

        $this->line('');
        $this->line("<info>Total database queries:</info> {$totalQueries}");

        foreach ($queries as $index => $query) {
            $this->line('  ' . ($index + 1) . '. ' . $query['query'] . ' [' . collect($query['bindings'])->join(',') . ']');
        }

        if ($totalQueries === 1) {
            $this->components->info('SUCCESS: Duplicate queries prevented by global primary key cache.');
        } else {
            $this->components->error("FAILURE: Duplicate queries still occurring ({$totalQueries} queries executed).");
        }

        return 0;
    }

    protected function resolveModel(): ?string
    {
        $modelFiles = glob(app_path('Models/*.php'));

        foreach ($modelFiles as $file) {
            $modelName = basename($file, '.php');
            $optionName = str($modelName)->append('s')->lower()->toString();

            if ($this->option($optionName)) {
                return "App\\Models\\{$modelName}";
            }
        }

        $model = $this->option('model');

        if (Reflector::isCallable($model)) {
            return $model;
        }

        $appModel = 'App\\Models\\' . str($model)->singular()->ucfirst();

        if (Reflector::isCallable($appModel)) {
            return $appModel;
        }

        $this->components->error('Model or table option not recognized.');

        return null;
    }
}
