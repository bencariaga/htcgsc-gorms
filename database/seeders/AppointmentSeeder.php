<?php

namespace Database\Seeders;

use App\{Actions\Data\GenerateDatabaseTableRowId, Enums\ReferralType, Models\Appointment, Models\Student};
use Illuminate\{Database\Seeder, Support\Collection};

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            return;
        }

        Collection::times(5, fn () => $this->createAppointment($students->random(), $students->random(), ReferralType::Yourself));

        Collection::times(5, function () use ($students) {
            $referrer = $students->random();
            $referral = $students->where('student_id', '!=', $referrer->student_id);

            if ($referral->isNotEmpty()) {
                $this->createAppointment($referrer, $referral->random(), ReferralType::SomeoneElse);
            }
        });
    }

    private function createAppointment(Student $referrerStudent, Student $referralStudent, ReferralType $type): void
    {
        $ids = [];

        collect(['referrer' => $referrerStudent, 'referral' => $referralStudent])->each(function ($student, $key) use (&$ids) {
            $model = str($key)->studly()->toString();
            $ids["{$key}_id"] = GenerateDatabaseTableRowId::execute(str($key)->plural(), "{$key}_id");
            ("App\\Models\\{$model}")::create(["{$key}_id" => $ids["{$key}_id"], 'student_id' => $student->student_id]);
        });

        Appointment::factory()->create([
            'appointment_id' => GenerateDatabaseTableRowId::execute('appointments', 'appointment_id'),
            'referrer_id' => $ids['referrer_id'],
            'referral_id' => $ids['referral_id'],
            'referral_type' => $type,
        ]);
    }
}
