<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\{Facades\DB, Facades\Log, ServiceProvider};

class DatabaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Model::unguard();

        Model::shouldBeStrict(!app()->isProduction());

        Model::automaticallyEagerLoadRelationships();

        Model::preventLazyLoading(!app()->isProduction());

        DB::prohibitDestructiveCommands(app()->isProduction());

        $this->configureDuplicateQueryDetector();
    }

    private function configureDuplicateQueryDetector(): void
    {
        if (app()->isProduction()) {
            return;
        }

        $recordedQueries = [];

        DB::listen(function ($query) use (&$recordedQueries) {
            $signature = str($query->sql)->append(serialize($query->bindings))->hash('md5')->toString();

            if (collect($recordedQueries)->has($signature)) {
                $sql = $query->sql;

                $bindings = $query->bindings;

                $time = "{$query->time}ms";

                $url = request()->fullUrl();

                Log::warning('Duplicate Database Query Detected:', collect([$sql, $bindings, $time, $url])->values()->all());
            }

            $recordedQueries[$signature] = true;
        });
    }
}
