<?php

namespace App\Components\Molecules\Modals;

use Illuminate\{Support\ViewErrorBag, View\Component};

class UserProfileModal extends Component
{
    public bool $hasPasswordErrors = false;

    public function __construct(public string $fullName, public mixed $user)
    {
        $this->resolveErrors();
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
        return view('components.molecules.modals.user-profile-modal');
    }
}
