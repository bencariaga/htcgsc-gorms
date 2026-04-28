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
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'suffix' => $data['suffix'],
                'email_address' => $data['email_address'],
                'phone_number' => $data['phone_number'],
            ]);

            Log::info("Student record updated successfully for Student ID: {$data['student_id']}");
        }, 'Failed to update student record', ['student_id' => $data['student_id']]);
    }
}
