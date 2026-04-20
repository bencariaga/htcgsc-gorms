<?php

namespace App\Observers;

use App\Models\Referral;

class ReferralObserver
{
    /**
     * Handle the Referral "created" event.
     */
    public function created(Referral $referral): void
    {
        //
    }

    /**
     * Handle the Referral "updated" event.
     */
    public function updated(Referral $referral): void
    {
        //
    }

    /**
     * Handle the Referral "deleted" event.
     */
    public function deleted(Referral $referral): void
    {
        //
    }

    /**
     * Handle the Referral "restored" event.
     */
    public function restored(Referral $referral): void
    {
        //
    }

    /**
     * Handle the Referral "force deleted" event.
     */
    public function forceDeleted(Referral $referral): void
    {
        //
    }
}
