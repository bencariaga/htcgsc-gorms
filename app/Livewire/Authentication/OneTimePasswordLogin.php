<?php

namespace App\Livewire\Authentication;

use App\{Livewire\Bases\BaseOTPType, Services\Miscellaneous\OTPService};
use Illuminate\Support\Facades\{Auth, Session};
use Livewire\Attributes\Title;

#[Title('Verify Login')]
class OneTimePasswordLogin extends BaseOTPType
{
    public string $fallbackRoute = 'login';

    protected function getIdentifier(): string
    {
        return $this->identifier;
    }

    protected function handleSuccess(OTPService $service): void
    {
        $user = $service->findUserByIdentifier($this->identifier);
        Auth::login($user, Session::get('otp_remember'));
        redirect()->route('dashboard.index');
    }
}
