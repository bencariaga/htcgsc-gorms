<?php

namespace App\Http\Requests;

use App\{Enums\PersonSuffix, Models\Student, Support\Regex};
use App\Rules\{DuplicateContactDetails, EmailAddressFormat};
use Illuminate\{Foundation\Http\FormRequest, Validation\Rule};

class UpdateStudentProfile extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->input('student_id');
        $student = Student::where('student_id', $studentId)->first();
        $personId = $student?->person_id;

        return [
            'student_id' => ['required', Rule::exists('students', 'student_id')],
            'first_name' => ['required', 'string', 'max:20', 'regex:' . Regex::firstName()],
            'last_name' => ['required', 'string', 'max:20'],
            'middle_name' => ['nullable', 'string', 'max:20'],
            'suffix' => ['nullable', 'string', Rule::in(PersonSuffix::values())],
            'email_address' => ['required', 'email', 'max:60', new DuplicateContactDetails('email_address', $personId, 'student'), new EmailAddressFormat],
            'phone_number' => ['nullable', 'string', 'max:16', new DuplicateContactDetails('phone_number', $personId, 'student')],
        ];
    }
}
