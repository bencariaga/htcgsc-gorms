<?php

namespace Database\Factories;

use App\Enums\{AppointmentStatus, AppointmentTime, ReferralType};
use App\Models\{Appointment, Referral, Referrer};
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /** @var string */
    protected $model = Appointment::class;

    public function definition(): array
    {
        $created_at = fake()->dateTimeBetween('-1 month', 'now', config('app.timezone'));
        $updated_at = fake()->dateTimeBetween($created_at, 'now', config('app.timezone'));
        $locale = 'en_PH';

        return [
            'referral_id' => Referral::factory(),
            'referrer_id' => Referrer::factory(),
            'referral_type' => ReferralType::Yourself,
            'reason' => fake($locale)->sentence(),
            'appointment_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'appointment_time' => fake()->randomElement(AppointmentTime::cases()),
            'appointment_status' => AppointmentStatus::Scheduled,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
