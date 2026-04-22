<?php

namespace Database\Seeders;

use App\Enums\{AppointmentStatus, AppointmentTime, ReferralType};
use App\Models\{Appointment, Referral, Referrer, Student};
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 5; $i++) {
            $this->generateAppointment($students->random(), $students->random(), ReferralType::Yourself);
        }

        for ($i = 0; $i < 5; $i++) {
            $referrer = $students->random();
            $referral = $students->where('student_id', '!=', $referrer->student_id)->random();

            $this->generateAppointment($referrer, $referral, ReferralType::SomeoneElse);
        }
    }

    private function generateAppointment(Student $referrerStudent, Student $referralStudent, ReferralType $type): void
    {
        $referrer = Referrer::create([
            'student_id' => $referrerStudent->student_id,
        ]);

        $referral = Referral::create([
            'student_id' => $referralStudent->student_id,
        ]);

        Appointment::create([
            'reason' => fake('en_PH')->sentence(),
            'appointment_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'appointment_time' => fake()->randomElement(AppointmentTime::cases()),
            'appointment_status' => AppointmentStatus::Scheduled,
            'referrer_id' => $referrer->referrer_id,
            'referral_id' => $referral->referral_id,
            'referral_type' => $type,
        ]);
    }
}
