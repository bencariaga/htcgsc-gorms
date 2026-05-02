<?php

namespace App\Services\Miscellaneous;

use App\Actions\Profile\{HandleProfileUpdate, PrepareProfileUpdatedEvent, UpdateUserProfile, UpdateUserProfilePicture};
use App\Actions\User\ResetUserPassword;
use App\{Data\PasswordResetData, Models\User};
use Exception;
use Illuminate\Http\{Request, UploadedFile};
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProfileService
{
    public function handleUpdate(User $user, array $validated, OTPService $otpService, UploadedFile|TemporaryUploadedFile|null $profilePicture = null, bool $removePicture = false): ?string
    {
        return app(HandleProfileUpdate::class)->handle($user, $validated, $otpService, $profilePicture, $removePicture);
    }

    public function refreshAndGetPayload(User $user): array
    {
        return app(PrepareProfileUpdatedEvent::class)->handle($user);
    }

    public function updateBasicInfo(User $user, array $data): void
    {
        app(UpdateUserProfile::class)->handle($user, $data);
    }

    public function updateProfilePicture(User $user, UploadedFile|TemporaryUploadedFile|null $file, bool $remove = false): void
    {
        app(UpdateUserProfilePicture::class)->handle($user, $file, $remove);
    }

    public function handleProfilePicture(User $user, Request $request): void
    {
        $this->updateProfilePicture($user, $request->file('profile_picture'), $request->input('remove_picture') === '1');
    }

    public function resetPassword(PasswordResetData $data, User $targetUser): bool
    {
        $success = app(ResetUserPassword::class)->execute($data);

        if (!$success) {
            throw new Exception('Failed to update password.');
        }

        return $targetUser->user_id === Auth::id();
    }
}
