<?php

namespace App\Actions\Student;

use App\Models\Student;

class UpdateStudent
{
    public function handle(array $data): void
    {
        $student = Student::findOrFail($data['student_id']);

        $student->person->update([
            'last_name' => $data['lastName'],
            'first_name' => $data['firstName'],
            'middle_name' => $data['middleName'],
            'suffix' => $data['suffix'],
            'email_address' => $data['email'],
            'phone_number' => $data['phoneNumber'],
        ]);
    }
}
