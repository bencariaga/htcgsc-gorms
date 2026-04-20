<?php

namespace App\Livewire\Authentication;

use App\{Actions\User\ResetUserPassword, Data\PasswordResetData, Http\Requests\UpdateUserPassword};
use Illuminate\Validation\ValidationException;
use Livewire\{Attributes\Layout, Attributes\Title, Component};

class ForgotPassword extends Component
{
    public string $identifier = '';

    public string $full_name = '';

    public string $newPassword = '';

    public string $newPassword_confirmation = '';

    protected function rules(): array
    {
        return (new UpdateUserPassword)->rules($this->identifier);
    }

    protected array $messages = [
        'identifier.required' => 'This field is required.',
        'full_name.required' => 'This field is required.',
        'newPassword.confirmed' => 'The passwords do not match with each other.',
    ];

    public function resetPassword(ResetUserPassword $action)
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatch('validation-failed');
            /** @var \Throwable $e */
            throw $e;
        }

        $data = new PasswordResetData($this->identifier, $this->newPassword);

        if ($action->execute($data)) {
            return redirect()->route('login')->with('success', 'Password reset has been done successfully! You can now login.');
        }

        $this->addError('identifier', 'System error occurred.');
        $this->dispatch('validation-failed');
    }

    #[Layout('layouts.authentication-pages')]
    #[Title('Forgot Password')]
    public function render()
    {
        return view('livewire.authentication.forgot-password');
    }
}
