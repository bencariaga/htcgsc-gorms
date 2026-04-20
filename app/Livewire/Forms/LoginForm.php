<?php

namespace App\Livewire\Forms;

use App\Actions\User\AuthenticateUser;
use Livewire\Form;

class LoginForm extends Form
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function rules()
    {
        return ['email' => ['required'], 'password' => ['required', 'min:8']];
    }

    public function authenticate(AuthenticateUser $action)
    {
        $this->validate();

        return $action->execute($this->email, $this->password, $this->remember);
    }
}
