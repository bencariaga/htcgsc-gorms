<?php

namespace App\Livewire\Forms;

use App\{Models\Person, Rules\DuplicateContactDetails, Rules\EmailAddressFormat};
use Illuminate\Validation\Rule;
use Livewire\Form;

class RegisterForm extends Form
{
    public string $firstName = '';

    public string $lastName = '';

    public ?string $middleName = '';

    public ?string $suffix = '';

    public string $email = '';

    public ?string $phoneNumber = '';

    public string $password = '';

    public string $password_confirmation = '';

    public mixed $profilePicture = null;

    public function rules()
    {
        return [
            'firstName' => ['required', 'string', 'max:20'],
            'lastName' => ['required', 'string', 'max:20'],
            'middleName' => ['nullable', 'string', 'max:20'],
            'suffix' => ['nullable', 'string', Rule::in(['Sr.', 'Jr.', 'II', 'III', 'IV', 'V', 'VI'])],
            'email' => [
                'required',
                'email',
                'max:60',
                new DuplicateContactDetails('email_address'),
                new EmailAddressFormat,
            ],
            'phoneNumber' => ['nullable', 'string', 'max:16', new DuplicateContactDetails('phone_number')],
            'password' => ['required', 'min:8', 'confirmed'],
            'profilePicture' => ['nullable', 'image', 'max:8192'],
        ];
    }

    public function ensureAccountDoesNotExist()
    {
        return Person::where('first_name', $this->firstName)->where('last_name', $this->lastName)->where('middle_name', $this->middleName)->where('suffix', $this->suffix)->exists();
    }
}
