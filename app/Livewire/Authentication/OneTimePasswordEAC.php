<?php

namespace App\Livewire\Authentication;

use App\Livewire\Bases\BaseOTPType;
use Livewire\Attributes\Title;

#[Title('Verify Email Address Change')]
class OneTimePasswordEAC extends BaseOTPType
{
    protected string $updateField = 'email_address';

    protected function getIdentifier(): string
    {
        return $this->identifier;
    }
}
