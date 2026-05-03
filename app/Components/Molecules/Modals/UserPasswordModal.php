<?php

namespace App\Components\Molecules\Modals;

use Illuminate\{Support\ViewErrorBag, View\Component};

class UserPasswordModal extends Component
{
    public bool $hasPasswordErrors = false;
    public array $passwordFields = [];

    public function __construct(public string $fullName, public mixed $user)
    {
        $this->resolveErrors();

        $this->passwordFields = [
            ['name' => 'full_name', 'label' => 'Full Name', 'icon' => 'fa-user', 'placeholder' => $this->fullName, 'type' => 'text'],
            ['name' => 'newPassword', 'label' => 'New Password', 'icon' => 'fa-lock', 'placeholder' => 'Minimum is 8 characters.', 'type' => 'password', 'canToggle' => true],
            ['name' => 'newPassword_confirmation', 'label' => 'Confirm New Password', 'icon' => 'fa-check-double', 'placeholder' => 'Repeat that password.', 'type' => 'password', 'canToggle' => true],
        ];
    }

    private function resolveErrors(): void
    {
        $errors = session('errors');

        if (!$errors instanceof ViewErrorBag) {
            return;
        }

        $passwordErrorKeys = ['newPassword', 'full_name'];

        foreach ($passwordErrorKeys as $key) {
            if ($errors->has($key)) {
                $this->hasPasswordErrors = true;

                return;
            }
        }
    }

    public function render()
    {
        return view('components.molecules.modals.user-password-modal');
    }
}
