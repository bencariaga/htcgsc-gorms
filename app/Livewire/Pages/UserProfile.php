<?php

namespace App\Livewire\Pages;

use App\{Actions\Auth\LogoutUser, Data\PasswordResetData, Models\Person, Models\User};
use App\Livewire\Forms\{PasswordChangeForm, UserProfileForm};
use App\Services\Miscellaneous\{OTPService, ProfileService};
use Exception;
use Illuminate\Support\Facades\{Auth, Log};
use Livewire\{Attributes\Layout, Attributes\On, Attributes\Title, Component, WithFileUploads};

#[Title('User Profile')]
#[Layout('layouts.personal-pages', ['padding' => '1rem', 'important' => '!important'])]
class UserProfile extends Component
{
    use WithFileUploads;

    public UserProfileForm $form;

    public PasswordChangeForm $passwordForm;

    public ?User $user = null;

    public ?Person $person = null;

    public string $fullName = '';

    #[On('refreshList')]
    #[On('refreshProfile')]
    public function refreshData(): void
    {
        $this->mount($this->user);
    }

    public function mount(?User $user = null): void
    {
        $this->user = $user ?? Auth::user();
        $this->user->load('person');
        $this->person = $this->user->person;
        $this->fullName = $this->person->full_name;
        $this->form->setValues($this->user);
        $this->passwordForm->identifier = $this->person->email_address ?? $this->person->phone_number;
    }

    public function submit(OTPService $otpService, ProfileService $profileService): void
    {
        $validated = $this->form->validate();

        try {
            $redirectRoute = $profileService->handleUpdate($this->user, $validated, $otpService, $this->form->profile_picture, $this->form->remove_picture === '1');

            if ($redirectRoute) {
                $this->dispatch('hide-loading-accounts');
                redirect()->route($redirectRoute);

                return;
            }

            $this->dispatch('hide-loading-accounts');
            $this->dispatch('notify', type: 'success', message: 'User profile has been updated successfully!');
            $payload = $profileService->refreshAndGetPayload($this->user);
            $this->dispatch('profile-updated', ...$payload);
            $this->mount($this->user);
        } catch (Exception $e) {
            $this->dispatch('hide-loading-accounts');
            $this->addError('profile_error', "User profile update failed: {$e->getMessage()}");
        }
    }

    public function updatePassword(ProfileService $profileService): void
    {
        $this->passwordForm->validate();

        try {
            $shouldLogout = $profileService->resetPassword(new PasswordResetData(identifier: $this->passwordForm->identifier, newPassword: $this->passwordForm->newPassword), $this->user);

            if ($shouldLogout) {
                app(LogoutUser::class)->handle();
                redirect()->to('/')->with('success', 'Password has been updated successfully! Please log in again.');

                return;
            }

            $this->dispatch('notify', type: 'success', message: 'Password has been updated successfully!');
            $this->passwordForm->reset(['newPassword', 'newPassword_confirmation', 'full_name_confirmation']);
        } catch (Exception $e) {
            Log::error("Password update failed: {$e->getMessage()}");
            $this->addError('password_error', 'Something went wrong while updating the password.');
        }
    }

    public function render()
    {
        return view('livewire.pages.user-profile');
    }
}
