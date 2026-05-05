<?php

namespace Database\Factories;

use App\Models\{Referral, Student};
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferralFactory extends Factory
{
    protected $model = Referral::class;

    public function definition(): array
    {
        return ['student_id' => Student::factory()];
    }
}
