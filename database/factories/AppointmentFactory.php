<?php

namespace Database\Factories;

use App\{Enums\AppointmentStatus, Enums\AppointmentTime, Models\Appointment};
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /** @var string */
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'reason' => fake()->sentence(),
            'appointment_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'appointment_time' => fake()->randomElement(AppointmentTime::cases()),
            'appointment_status' => AppointmentStatus::Scheduled,
        ];
    }
}
