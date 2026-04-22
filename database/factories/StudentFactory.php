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
        $created_at = fake()->dateTimeBetween('-1 month', 'now');
        $updated_at = fake()->dateTimeBetween($created_at, 'now');

        return [
            'person_id' => Person::factory()->state(['type' => PersonType::Student]),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
