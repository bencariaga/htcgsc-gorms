<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $models = ['User', 'Student', 'Appointment', 'Report'];

        foreach ($models as $model) {
            $this->call("Database\\Seeders\\{$model}Seeder");
        }
    }
}
