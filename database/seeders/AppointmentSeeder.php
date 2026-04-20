<?php

namespace Database\Seeders;

use App\{Actions\Data\GenerateDatabaseTableRowId, Models\Student};
use Illuminate\{Database\Seeder, Support\Arr, Support\Facades\DB};

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        if ($students->count() < 10) {
            $students = Student::factory()->count(10)->create();
        }

        $shuffledStudents = $students->shuffle();
        $referrers = $shuffledStudents->take(5);
        $referrals = $shuffledStudents->slice(5, 5);

        $reasons = [
            'Showing signs of severe anxiety',
            'Frequent absences from major subjects',
            'Observed behavioral changes in class',
            'Peer conflict resolution needed',
            'Academic underperformance intervention',
        ];

        $timeSlots = ['8:30 AM - 9:30 AM', '9:30 AM - 10:30 AM', '10:30 AM - 11:30 AM', '1:30 PM - 2:30 PM', '2:30 PM - 3:30 PM', '3:30 PM - 4:30 PM'];

        foreach ($referrers as $index => $referrerStudent) {
            $referralStudent = $referrals->values()[$index];

            $referrerId = GenerateDatabaseTableRowId::execute('referrers', 'referrer_id');

            DB::table('referrers')->insert([
                'referrer_id' => $referrerId,
                'student_id' => $referrerStudent->student_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $referralId = GenerateDatabaseTableRowId::execute('referrals', 'referral_id');

            DB::table('referrals')->insert([
                'referral_id' => $referralId,
                'student_id' => $referralStudent->student_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('appointments')->insert([
                'appointment_id' => GenerateDatabaseTableRowId::execute('appointments', 'appointment_id'),
                'referrer_id' => $referrerId,
                'referral_id' => $referralId,
                'referral_type' => 'Someone Else',
                'reason' => $reasons[$index],
                'appointment_date' => now()->addDays($index + 1)->format('Y-m-d'),
                'appointment_time' => Arr::random($timeSlots),
                'appointment_status' => 'Scheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
