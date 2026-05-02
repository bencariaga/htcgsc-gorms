<?php

namespace App\Actions\Profile;

use Illuminate\Support\Facades\Session;

class StorePendingProfileUpdate
{
    public function handle(int $userId, string $key, string $value, array $pendingData): void
    {
        $otp_email = ($key === 'otp_email') ? $value : null;
        $otp_phone = ($key === 'otp_phone') ? $value : null;

        $pending_profile_update = $pendingData;
        $pending_profile_user_id = $userId;

        Session::put(compact('otp_email', 'otp_phone', 'pending_profile_update', 'pending_profile_user_id'));
    }
}
