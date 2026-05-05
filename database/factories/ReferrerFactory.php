<?php

namespace Database\Factories;

use App\Models\{Referrer, Student};
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferrerFactory extends Factory
{
    protected $model = Referrer::class;

    public function definition(): array
    {
        return ['student_id' => Student::factory()];
    }
}
