<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\{Database\Seeder, Support\Collection};

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Collection::range(1, 10) as $index) {
            Student::factory()->create();
        }
    }
}
