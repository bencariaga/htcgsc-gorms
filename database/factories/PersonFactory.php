<?php

namespace Database\Factories;

use App\{Actions\Data\GenerateDatabaseTableRowId, Enums\PersonSuffix, Models\Person};
use Illuminate\{Database\Eloquent\Factories\Factory, Support\Arr};

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition(): array
    {
        return [
            'person_id' => GenerateDatabaseTableRowId::execute('persons', 'person_id'),
            'type' => 'Student',
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'suffix' => fake()->optional(0.1)->randomElement(Arr::pluck(PersonSuffix::cases(), 'value')),
            'email_address' => fake()->unique()->safeEmail(),
            'phone_number' => '09' . fake()->numerify('#########'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
