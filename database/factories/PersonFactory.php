<?php

namespace Database\Factories;

use App\{Enums\PersonSuffix, Models\Person};
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /** @var string */
    protected $model = Person::class;

    public function definition(): array
    {
        $prefixes = ['0908', '0917', '0918', '0919', '0920', '0998'];

        return [
            'type' => null,
            'last_name' => fake('en_PH')->lastName(),
            'first_name' => fake('en_PH')->firstName(),
            'middle_name' => fake('en_PH')->lastName(),
            'suffix' => fake()->boolean(20) ? collect(PersonSuffix::cases())->random() : null,
            'email_address' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->numerify(fake()->randomElement($prefixes) . '#######'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function administrator(): self
    {
        return $this->state(fn (): array => [
            'first_name' => 'Benhur',
            'last_name' => 'Cariaga',
            'middle_name' => 'Leproso',
            'phone_number' => '09939597683',
            'email_address' => 'bencariaga13@gmail.com',
        ]);
    }
}
