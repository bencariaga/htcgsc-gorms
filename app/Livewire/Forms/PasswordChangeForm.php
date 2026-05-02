<?php

namespace App\Livewire\Forms;

use App\Http\Requests\UpdateUserPassword;
use Livewire\Form;

class PasswordChangeForm extends Form
{
    public ?string $identifier = '';

    public ?string $full_name_confirmation = '';

    public ?string $newPassword = '';

    public ?string $newPassword_confirmation = '';

    public function rules(): array
    {
        return (new UpdateUserPassword)->rules($this->identifier);
    }

    public function validationAttributes(): array
    {
        return ['full_name_confirmation' => 'full name', 'newPassword' => 'new password'];
    }
}
