<?php

namespace App\Observers;

use App\Models\Referrer;

class ReferrerObserver
{
    /**
     * Handle the Referrer "created" event.
     */
    public function created(Referrer $referrer): void
    {
        //
    }

    /**
     * Handle the Referrer "updated" event.
     */
    public function updated(Referrer $referrer): void
    {
        //
    }

    /**
     * Handle the Referrer "deleted" event.
     */
    public function deleted(Referrer $referrer): void
    {
        //
    }

    /**
     * Handle the Referrer "restored" event.
     */
    public function restored(Referrer $referrer): void
    {
        //
    }

    /**
     * Handle the Referrer "force deleted" event.
     */
    public function forceDeleted(Referrer $referrer): void
    {
        //
    }
}
