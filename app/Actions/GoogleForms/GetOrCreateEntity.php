<?php

namespace App\Actions\GoogleForms;

use App\Models\{Person, Referral, Referrer, Student};
use App\Services\Miscellaneous\SanitizationService;

class GetOrCreateEntity
{
    protected SanitizationService $sanitizationService;

    public function __construct(SanitizationService $sanitizationService)
    {
        $this->sanitizationService = $sanitizationService;
    }

    public function execute(array $data, string $type)
    {
        $email = $this->sanitizationService->sanitizeEmail($data["School Email Address ($type)"] ?? '');

        $person = Person::updateOrCreate(
            ['email_address' => $email],
            [
                'type' => 'Student',
                'last_name' => $this->sanitizationService->sanitizeName($data["Last Name ($type)"] ?? ''),
                'first_name' => $this->sanitizationService->sanitizeName($data["First Name ($type)"] ?? ''),
                'middle_name' => $this->sanitizationService->sanitizeName($data["Middle Name ($type)"] ?? ''),
                'phone_number' => $this->sanitizationService->sanitizePhoneNumber($data["Phone Number ($type)"] ?? ''),
            ],
        );

        $student = Student::updateOrCreate(['person_id' => $person->person_id]);

        return match ($type) {
            'Referrer' => Referrer::updateOrCreate(['student_id' => $student->student_id]),
            default => Referral::updateOrCreate(['student_id' => $student->student_id]),
        };
    }
}
