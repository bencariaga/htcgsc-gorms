<?php

namespace App\Components;

use App\Enums\NonDB\EmailAndPageOTP;
use Illuminate\View\Component;

class OTPPage extends Component
{
    public function __construct(public string $type, public string $identifier) {}

    public function getTitle(): string
    {
        return EmailAndPageOTP::tryFrom($this->type)?->getPageTitle() ?? 'Verify OTP';
    }

    public function getDescription(): string
    {
        return EmailAndPageOTP::tryFrom($this->type)?->getDescription() ?? 'Enter the 6-digit code sent to';
    }

    public function getLoadingMessage(): string
    {
        return $this->type === 'login' ? 'Going back to the login page...' : 'Going back to the user profile page...';
    }

    public function getBackButtonText(): string
    {
        return $this->type === 'login' ? 'Back to Login Page' : 'Back to Profile Page';
    }

    public function render()
    {
        return view('livewire.layouts.otp-page', [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'loadingMessage' => $this->getLoadingMessage(),
            'backButtonText' => $this->getBackButtonText(),
        ]);
    }
}
