<?php

namespace App\Livewire\Bases;

use App\{Models\User, Services\Miscellaneous\OTPService, Traits\Handles\HandlesOTP};
use Illuminate\Support\Facades\Session;
use Livewire\{Attributes\Layout, Component};

#[Layout('layouts.authentication-pages')]
abstract class BaseOTPType extends Component
{
    use HandlesOTP;

    public ?string $identifier;

    public string $sessionKey = 'otp_email';

    public string $fallbackRoute = 'user-profile.index';

    protected string $updateField;

    protected function handleSuccess(OTPService $service): void
    {
        $targetUserId = $this->updatePendingProfile($this->updateField);
        $readableField = str($this->updateField)->replace('_', ' ')->ucfirst();

        redirect()->route('user-profile.index', ['user' => $targetUserId])->with('success', "{$readableField} updated successfully!");
    }

    public function mount()
    {
        $this->identifier = Session::get($this->sessionKey);

        if (!$this->identifier) {
            redirect()->route($this->fallbackRoute);

            return;
        }

        $this->reset('otp_array');
    }

    protected function updatePendingProfile(string $verifiedField)
    {
        $targetUserId = Session::get('pending_profile_user_id');
        $targetUser = User::with('person')->findOrFail($targetUserId);
        $pending = Session::get('pending_profile_update');

        $mappedData = [
            'first_name' => $pending['first_name'] ?? $targetUser->person->first_name,
            'last_name' => $pending['last_name'] ?? $targetUser->person->last_name,
            'middle_name' => $pending['middle_name'] ?? $targetUser->person->middle_name,
            'suffix' => $pending['suffix'] ?? $targetUser->person->suffix,
            'email_address' => $pending['email_address'] ?? $targetUser->person->email_address,
            'phone_number' => $pending['phone_number'] ?? $targetUser->person->phone_number,
        ];

        $mappedData[$verifiedField] = $this->identifier;
        $targetUser->person->update($mappedData);

        return $targetUserId;
    }

    public function goBack()
    {
        redirect()->route($this->fallbackRoute);
    }

    public function render()
    {
        $view = str(static::class)->after('App\\Livewire\\')->explode('\\')->map(fn ($segment) => str($segment)->kebab())->implode('.');
        $livewireComponent = "livewire.{$view}";

        return view($livewireComponent);
    }
}
