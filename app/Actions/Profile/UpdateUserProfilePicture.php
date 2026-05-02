<?php

namespace App\Actions\Profile;

use App\{Models\User, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\Facades\{Log, Storage};
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UpdateUserProfilePicture
{
    use ManagesTransactions;
    
    public function handle(User $user, UploadedFile|TemporaryUploadedFile|null $file, bool $remove = false): void
    {
        if (!$file && !$remove) {
            return;
        }

        $this->executeTransaction(function () use ($user, $file) {
            $this->deleteOldPicture($user);
            $path = $file?->store('profile-pictures', 'public');
            $user->update(['profile_picture' => $path]);
            Log::info("Profile picture updated for User ID: {$user->user_id}");
        }, 'Failed to update profile picture', ['user_id' => $user->user_id]);
    }

    protected function deleteOldPicture(User $user): void
    {
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
    }
}
