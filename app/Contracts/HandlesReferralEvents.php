<?php

namespace App\Contracts;

use App\Models\Referral;

interface HandlesReferralEvents
{
    public function created(Referral $referral): void;
}
