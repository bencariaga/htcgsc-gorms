<?php

namespace App\Observers;

use App\{Contracts\HandlesReferrerEvents, Data\ReferrerData, Models\Referrer};
use Illuminate\Support\Facades\Log;

class ReferrerObserver implements HandlesReferrerEvents
{
    public function created(Referrer $referrer): void
    {
        Log::info('Referrer created.', ReferrerData::fromModel($referrer)->toArray());
    }
}
