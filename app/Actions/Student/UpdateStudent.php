<?php

namespace App\Actions\Student;

use App\{Models\Student, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\Facades\Log;

class UpdateStudent
{
    use ManagesTransactions;

    public function handle(array $data): void
    {
        $this->executeTransaction(function () use ($data) {
            $student = Student::with('person')->findOrFail($data['student_id']);

            $student->person->update([
                'last_name' => $data['lastName'],
                'first_name' => $data['firstName'],
                'middle_name' => $data['middleName'],
                'suffix' => $data['suffix'],
                'email_address' => $data['email'],
                'phone_number' => $data['phoneNumber'],
            ]);

            Log::info("Student record updated successfully for Student ID: {$data['student_id']}");
        }, 'Failed to update student record', ['student_id' => $data['student_id']]);
    }
}
