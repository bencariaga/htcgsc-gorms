<?php

namespace Database\Factories;

use App\Models\{Appointment, Referral, Referrer};
use Illuminate\{Database\Eloquent\Factories\Factory, Support\Number};

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'referrer_id' => Referrer::factory(),
            'referral_id' => Referral::factory(),
            'referral_type' => 'Someone Else',
            'reason' => fake()->randomElement([
                'Showing signs of severe anxiety',
                'Frequent absences from major subjects',
                'Observed behavioral changes in class',
                'Peer conflict resolution needed',
                'Academic underperformance intervention',
            ]),
            'appointment_date' => now()->next('Monday')->addDays(Number::clamp(random_int(0, 4), 0, 4))->format('Y-m-d'),
            'appointment_time' => fake()->randomElement([
                '8:30 AM - 9:30 AM',
                '9:30 AM - 10:30 AM',
                '10:30 AM - 11:30 AM',
                '1:30 PM - 2:30 PM',
                '2:30 PM - 3:30 PM',
                '3:30 PM - 4:30 PM',
            ]),
            'appointment_status' => 'Scheduled',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
