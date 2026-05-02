<?php

namespace App\Actions\Student;

use App\{Actions\Person\UpdatePersonInfo, Models\Student, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\Facades\Log;

class UpdateStudent
{
    use ManagesTransactions;

    public function handle(array $data): void
    {
        $this->executeTransaction(function () use ($data) {
            $student = Student::with('person')->findOrFail($data['student_id']);
            app(UpdatePersonInfo::class)->handle($student->person, $data);
            Log::info("Student record updated successfully for Student ID: {$data['student_id']}");
        }, 'Failed to update student record', ['student_id' => $data['student_id']]);
    }
}
