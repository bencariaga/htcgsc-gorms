<?php

namespace App\Actions\Profile;

use App\Models\{Person, User};
use App\Services\Miscellaneous\OTPService;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class HandleProfileUpdate
{
    public function handle(User $user, array $validated, OTPService $otpService, UploadedFile|TemporaryUploadedFile|null $profilePicture = null, bool $removePicture = false): ?string
    {
        if (!$user->relationLoaded('person')) {
            $user->setRelation('person', Person::find($user->person_id));
        }

        $person = $user->person;

        foreach (['email_address' => 'otp_email', 'phone_number' => 'otp_phone'] as $field => $type) {
            $currentValue = ($field === 'email_address') ? $person->email_address : $person->phone_number;

            if (filled($validated[$field] ?? null) && $validated[$field] !== $currentValue) {
                if ($user->user_id !== auth()->id()) {
                    continue;
                }

                app(StorePendingProfileUpdate::class)->handle($user->getKey(), $type, $validated[$field], collect($validated)->except($field)->toArray());
                $otpService->generateAndSend($user, $validated[$field], true);

                return 'user-profile.' . ($field === 'email_address' ? 'otpEmail' : 'otpPhone');
            }
        }

        app(UpdateUserProfile::class)->handle($user, $validated);
        app(UpdateUserProfilePicture::class)->handle($user, $profilePicture, $removePicture);

        return null;
    }
}
