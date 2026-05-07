<?php

namespace Database\Factories;

use App\{Enums\PersonSuffix, Enums\PersonType, Models\Person};
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /** @var string */
    protected $model = Person::class;

    public function definition(): array
    {
        $prefixes = ['0908', '0917', '0918', '0919', '0920', '0998'];
        $created_at = fake()->dateTimeBetween('-1 month', 'now');
        $updated_at = fake()->dateTimeBetween($created_at, 'now');
        $locale = 'en_PH';

        return [
            'type' => PersonType::Employee,
            'last_name' => fake($locale)->lastName(),
            'first_name' => fake($locale)->firstName(),
            'middle_name' => fake($locale)->lastName(),
            'suffix' => fake()->boolean(20) ? collect(PersonSuffix::cases())->random() : null,
            'email_address' => fn (array $attributes) => match ($attributes['type'] ?? PersonType::Employee) {
                PersonType::Student => str(fake()->unique()->userName())->append('@online.htcgsc.edu.ph')->toString(),
                default => str(fake()->unique()->userName())->append('@gmail.com')->toString(),
            },
            'phone_number' => fake()->unique()->numerify(fake()->randomElement($prefixes) . '#######'),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
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
