<?php

namespace App\Livewire\Authentication;

use App\{Contracts\RegistersUser, Data\UserRegistrationData, Livewire\Forms\RegisterForm};
use Illuminate\Validation\ValidationException;
use Livewire\{Attributes\Layout, Attributes\Title, Component, WithFileUploads};
use Throwable;

class CreateAccount extends Component
{
    use WithFileUploads;

    public RegisterForm $form;

    public function register(RegistersUser $action)
    {
        try {
            $this->form->validate();

            if ($this->form->ensureAccountDoesNotExist()) {
                $this->addError('account_exists', 'This user account already exists.');
                $this->dispatch('validation-failed');

                return;
            }

            $action->execute(UserRegistrationData::from($this->form->all()));

            return redirect()->route('login')->with('success', 'Account creation request has been sent to the administrator.');
        } catch (ValidationException $e) {
            $this->dispatch('validation-failed');
            /** @var Throwable $e */
            throw $e;
        } catch (Throwable $e) {
            $this->addError('account_exists', 'A system error occurred. Please try again later.');
            throw $e;
        }
    }

    #[Layout('layouts.authentication-pages', ['maxWidth' => '1000px', 'important' => '!important'])]
    #[Title('Create Account')]
    public function render()
    {
        return view('livewire.authentication.create-account');
    }
}
