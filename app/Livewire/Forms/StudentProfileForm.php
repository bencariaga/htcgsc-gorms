<?php

namespace App\Livewire\Forms;

use App\Http\Requests\UpdateStudentProfile;
use Livewire\Form;

class StudentProfileForm extends Form
{
    public ?int $student_id = null;
    public ?string $last_name = '';
    public ?string $first_name = '';
    public ?string $middle_name = '';
    public ?string $suffix = '';
    public ?string $email_address = '';
    public ?string $phone_number = '';

    public function rules(): array
    {
        $request = new UpdateStudentProfile();
        $request->merge(['student_id' => $this->student_id]);

        return $request->rules();
    }

    public function setValues(array $data): void
    {
        $this->student_id = $data['student_id'] ?? null;
        $person = $data['person'] ?? $data;

        $this->last_name = $person['last_name'] ?? '';
        $this->first_name = $person['first_name'] ?? '';
        $this->middle_name = $person['middle_name'] ?? '';
        $this->suffix = $person['suffix'] ?? null;
        $this->email_address = $person['email_address'] ?? '';
        $this->phone_number = $person['phone_number'] ?? null;
    }
}
