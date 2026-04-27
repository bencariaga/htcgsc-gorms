<?php

namespace App\Services\Miscellaneous;

use App\Models\User;
use Illuminate\{Http\Request, Support\Facades\Session, Support\Facades\Storage};

class ProfileService
{
    public function handleUpdate(User $user, array $validated, OTPService $otpService): ?string
    {
        $user->loadMissing('person');
        $person = $user->person()->firstOrFail();

        foreach (['email_address' => 'otp_email', 'phone_number' => 'otp_phone'] as $field => $type) {
            $currentValue = ($field === 'email_address') ? $person->email_address : $person->phone_number;

            if (filled($validated[$field] ?? null) && $validated[$field] !== $currentValue) {
                $this->storePendingUpdate($user->getAttribute('user_id'), $type, $validated[$field], collect($validated)->except($field)->toArray());
                $otpService->generateAndSend($user, $validated[$field], true);

                return 'user-profile.' . ($field === 'email_address' ? 'otpEmail' : 'otpPhone');
            }
        }

        $this->updateBasicInfo($user, $validated);

        return null;
    }

    protected function storePendingUpdate(int $userId, string $key, string $value, array $pendingData): void
    {
        $otp_email = ($key === 'otp_email') ? $value : null;
        $otp_phone = ($key === 'otp_phone') ? $value : null;

        $pending_profile_update = $pendingData;
        $pending_profile_user_id = $userId;

        Session::put(compact('otp_email', 'otp_phone', 'pending_profile_update', 'pending_profile_user_id'));
    }

    public function updateBasicInfo(User $user, array $data): void
    {
        /** @var mixed $person */
        $person = $user->person()->firstOrFail();

        $last_name = $data['last_name'];
        $first_name = $data['first_name'];
        $middle_name = $data['middle_name'] ?: null;
        $suffix = $data['suffix'] ?: null;
        $email_address = $data['email_address'] ?? $person->email_address;
        $phone_number = $data['phone_number'] ?? $person->phone_number;

        $person->update(compact('last_name', 'first_name', 'middle_name', 'suffix', 'email_address', 'phone_number'));
    }

    public function handleProfilePicture(User $user, Request $request): void
    {
        if ($request->boolean('remove_picture') || $request->hasFile('profilePicture')) {
            $this->deleteOldPicture($user);
            $path = $request->hasFile('profilePicture') ? $request->file('profilePicture')->store('profile-pictures', 'public') : null;
            $user->update(['profile_picture' => $path]);
        }
    }

    protected function deleteOldPicture(User $user): void
    {
        $currentPath = $user->getAttribute('profile_picture');

        if ($currentPath) {
            Storage::disk('public')->delete($currentPath);
        }
    }
}
