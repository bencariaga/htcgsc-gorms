<?php

namespace App\Livewire\Authentication;

use App\Livewire\Bases\BaseOTPType;
use Livewire\Attributes\Title;

#[Title('Verify Phone Number Change')]
class OneTimePasswordPNC extends BaseOTPType
{
    public string $sessionKey = 'otp_phone';

    protected string $updateField = 'phone_number';

    protected function getIdentifier(): string
    {
        return $this->identifier;
    }
}
