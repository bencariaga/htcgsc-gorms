<?php

namespace App\Livewire\Authentication;

use App\Livewire\Bases\BaseOTPType;
use Livewire\Attributes\Title;

#[Title('Verify Phone Number Change')]
class OneTimePasswordPNC extends BaseOTPType
{
    protected string $updateField = 'phone_number';

    protected function getIdentifier(): string
    {
        return $this->identifier;
    }
}
