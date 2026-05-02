<?php

namespace App\Livewire\Authentication;

use App\{Contracts\AuthenticatesUser, Data\AuthenticateUserData};
use Illuminate\Validation\ValidationException;
use Livewire\{Attributes\Layout, Attributes\Title, Component};
use Throwable;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    protected array $rules = ['email' => ['required'], 'password' => ['required', 'min:8']];

    public function mount(): void
    {
        $this->reset(['email', 'password', 'remember']);
    }

    public function login(AuthenticatesUser $authenticator)
    {
        try {
            $this->validate();
            $data = new AuthenticateUserData(identifier: $this->email, password: $this->password, remember: $this->remember);
            $error = $authenticator->execute($data);

            if ($error) {
                $this->addError('email', $error);

                return;
            }

            return redirect()->route('otp-login');
        } catch (ValidationException $e) {
            /** @var Throwable $e */
            throw $e;
        } catch (Throwable $e) {
            $this->addError('email', 'An unexpected error occurred. Please try again.');
        }
    }

    #[Layout('layouts.authentication-pages')]
    #[Title('Login')]
    public function render()
    {
        return view('livewire.authentication.login');
    }
}
