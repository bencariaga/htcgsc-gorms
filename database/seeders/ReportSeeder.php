<?php

namespace Database\Seeders;

use App\{Enums\DataCategory, Enums\FileOutputFormat, Models\Report};
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Report::create([
                'title' => fake()->text(20),
                'start_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'end_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
                'data_category' => collect(DataCategory::cases())->random(),
                'file_output_format' => collect(FileOutputFormat::cases())->random(),
            ]);
        }
    }
}
