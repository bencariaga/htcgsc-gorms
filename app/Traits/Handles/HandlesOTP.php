<?php

namespace App\Traits\Handles;

use App\{Http\Requests\SendOneTimePassword, Services\Miscellaneous\OTPService};
use Illuminate\Support\{Facades\Auth, Facades\Session};

trait HandlesOTP
{
    public array $otp_array = ['', '', '', '', '', ''];

    public string $otp = '';

    abstract protected function getIdentifier(): string;

    abstract protected function handleSuccess(OTPService $service): void;

    protected function validateAndGetOtp(OTPService $service): ?string
    {
        $this->otp = collect($this->otp_array)->implode('');
        $request = new SendOneTimePassword;
        $this->validate(['otp' => $request->rules()['otp']], $request->messages());

        return $this->otp;
    }

    public function resend(): void
    {
        $service = app(OTPService::class);
        $this->resetErrorBag();
        $identifier = $this->getIdentifier();
        $user = Auth::user() ?? $service->findUserByIdentifier($identifier);

        if (!$user) {
            $this->addError('otp', 'User not found. Please try again.');

            return;
        }

        $isUpdate = str(static::class)->contains(['EAC', 'PNC']);
        $service->generateAndSend($user, $identifier, $isUpdate, true);
        $this->dispatch('resend-otp');
        $method = Session::get('otpMethod') === 'email' ? 'email address.' : 'phone number.';

        Session::flash('message', "A new OTP has been sent to your {$method}");
    }

    public function verify(): void
    {
        $service = app(OTPService::class);

        if (!$this->validateAndGetOtp($service)) {
            return;
        }

        $this->handleSuccess($service);

        Session::regenerate();

        Session::forget(['otp_code', 'otp_email', 'otp_phone', 'otp_remember', 'otp_expires_at', 'otp_method', 'pending_profile_update', 'pending_profile_user_id']);
    }
}
