<?php

namespace Database\Factories;

use App\Models\{Person, User};
use Illuminate\{Database\Eloquent\Factories\Factory, Support\Facades\Hash};

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'person_id' => Person::factory()->state(['type' => 'Employee']),
            'account_status' => 'Inactive',
            'password' => Hash::make('12345678'),
            'profile_picture' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
