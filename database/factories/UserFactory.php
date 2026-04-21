<?php

namespace Database\Factories;

use App\Actions\Data\GenerateDatabaseTableRowId;
use App\Enums\{AccountStatus, PersonType};
use App\Models\{Person, User};
use Illuminate\{Database\Eloquent\Factories\Factory, Support\Facades\Hash};

class UserFactory extends Factory
{
    /** @var string */
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'person_id' => Person::factory()->state(['type' => PersonType::Employee]),
            'user_id' => fn () => GenerateDatabaseTableRowId::execute('users', 'user_id'),
            'account_status' => AccountStatus::Inactive,
            'password' => Hash::make('12345678'),
            'profile_picture' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function active(): self
    {
        return $this->state(fn (): array => ['account_status' => AccountStatus::Active]);
    }

    public function administrator(): self
    {
        return $this->state(fn (): array => ['person_id' => Person::factory()->admin()->state(['type' => PersonType::Administrator])]);
    }
}
