<?php

namespace Database\Factories;

use App\Enums\{AccountStatus, PersonType};
use App\Models\{Person, User};
use Illuminate\{Database\Eloquent\Factories\Factory, Support\Facades\Hash};

class UserFactory extends Factory
{
    /** @var string */
    protected $model = User::class;

    public function definition(): array
    {
        $created_at = fake()->dateTimeBetween('-1 month', 'now');
        $updated_at = fake()->dateTimeBetween($created_at, 'now');

        return [
            'person_id' => Person::factory()->state(['type' => PersonType::Employee]),
            'account_status' => AccountStatus::Inactive,
            'password' => Hash::make('12345678'),
            'profile_picture' => null,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }

    public function active(): self
    {
        return $this->state(fn (): array => ['account_status' => AccountStatus::Active]);
    }

    public function administrator(): self
    {
        return $this->state(fn (): array => ['person_id' => Person::factory()->administrator()->state(['type' => PersonType::Administrator])]);
    }
}
