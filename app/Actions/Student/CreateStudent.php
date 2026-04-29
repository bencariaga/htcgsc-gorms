<?php

namespace App\Actions\Student;

use App\{Models\Person, Models\Student, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\Facades\Log;

class CreateStudent
{
    use ManagesTransactions;

    public function handle(array $data): int
    {
        return $this->executeTransaction(function () use ($data) {
            $person = Person::create([
                'type' => 'Student',
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'] ?? null,
                'suffix' => $data['suffix'] ?? null,
                'email_address' => $data['email_address'],
                'phone_number' => $data['phone_number'] ?? null,
            ]);

            $student = Student::create(['person_id' => $person->person_id]);

            Log::info("Student record created successfully with Student ID: {$student->student_id}");

            return $student->student_id;
        }, 'Failed to create student record', $data);
    }
}
