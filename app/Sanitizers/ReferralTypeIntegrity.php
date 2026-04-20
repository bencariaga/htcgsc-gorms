<?php

namespace App\Sanitizers;

class ReferralTypeIntegrity
{
    public function handle(array $data): array
    {
        if (($data['Referral Type'] ?? '') === 'Yourself') {
            $data['Last Name (Referral)'] = $data['Last Name (Referrer)'] ?? $data['Last Name (Referral)'];
            $data['First Name (Referral)'] = $data['First Name (Referrer)'] ?? $data['First Name (Referral)'];
        }

        return $data;
    }
}
