<?php

namespace App\Observers;

use App\{Contracts\HandlesReferralEvents, Data\ReferralData, Models\Referral};
use Illuminate\Support\Facades\Log;

class ReferralObserver implements HandlesReferralEvents
{
    public function created(Referral $referral): void
    {
        Log::info('Referral created.', ReferralData::fromModel($referral)->toArray());
    }
}
