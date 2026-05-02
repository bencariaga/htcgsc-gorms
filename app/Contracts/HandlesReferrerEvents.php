<?php

namespace App\Contracts;

use App\Models\Referrer;

interface HandlesReferrerEvents
{
    public function created(Referrer $referrer): void;
}
