<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*

        DB::listen(function ($query) {
            dump($query->sql);
            dump($query->bindings);
        });

        */

        $models = ['User', 'Student', 'Appointment', 'Report'];

        foreach ($models as $model) {
            $this->call("Database\\Seeders\\{$model}Seeder");
        }
    }
}
