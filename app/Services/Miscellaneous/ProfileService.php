<?php

namespace App\Services\Miscellaneous;

use App\Actions\Profile\{StorePendingProfileUpdate, UpdateProfileBasicInfo, UpdateProfilePicture};
use App\Models\User;
use Illuminate\Http\Request;

class ProfileService
{
    public function handleUpdate(User $user, array $validated, OTPService $otpService): ?string
    {
        $user->loadMissing('person');
        $person = $user->person()->firstOrFail();

        foreach (['email_address' => 'otp_email', 'phone_number' => 'otp_phone'] as $field => $type) {
            $currentValue = ($field === 'email_address') ? $person->email_address : $person->phone_number;

            if (filled($validated[$field] ?? null) && $validated[$field] !== $currentValue) {
                app(StorePendingProfileUpdate::class)->handle($user->getAttribute('user_id'), $type, $validated[$field], collect($validated)->except($field)->toArray());
                $otpService->generateAndSend($user, $validated[$field], true);

                return 'user-profile.' . ($field === 'email_address' ? 'otpEmail' : 'otpPhone');
            }
        }

        $this->updateBasicInfo($user, $validated);

        return null;
    }

    public function updateBasicInfo(User $user, array $data): void
    {
        app(UpdateProfileBasicInfo::class)->handle($user, $data);
    }

    public function handleProfilePicture(User $user, Request $request): void
    {
        app(UpdateProfilePicture::class)->handle($user, $request);
    }
}
