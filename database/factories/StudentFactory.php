<?php

namespace Database\Factories;

use App\{Enums\PersonType, Models\Person, Models\Student};
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /** @var string */
    protected $model = Student::class;

    public function definition(): array
    {
        return ['person_id' => Person::factory()->state(['type' => PersonType::Student])];
    }
}
