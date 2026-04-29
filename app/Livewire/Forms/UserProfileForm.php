<?php

namespace App\Livewire\Forms;

use App\{Http\Requests\UpdateUserProfile, Models\User};
use Livewire\Form;

class UserProfileForm extends Form
{
    public ?User $user = null;
    public ?int $user_id = null;
    public ?string $last_name = '';

    public ?string $first_name = '';

    public ?string $middle_name = '';

    public ?string $suffix = '';

    public ?string $email_address = '';

    public ?string $phone_number = '';

    public mixed $profile_picture = null;

    public string $remove_picture = '0';

    public function setValues(User $user): void
    {
        $this->user = $user;
        $this->user_id = $user->user_id;
        $user->loadMissing('person');
        $person = $user->person;

        $this->last_name = $person->last_name;
        $this->first_name = $person->first_name;
        $this->middle_name = $person->middle_name;
        $this->suffix = $person->suffix?->value;
        $this->email_address = $person->email_address;
        $this->phone_number = $person->phone_number;
    }

    public function rules(): array
    {
        return (new UpdateUserProfile)->rules();
    }
}
