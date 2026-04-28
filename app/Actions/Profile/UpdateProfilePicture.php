<?php

namespace App\Actions\Profile;

use App\Models\User;
use App\Traits\Miscellaneous\ManagesTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Log, Storage};

class UpdateProfilePicture
{
    use ManagesTransactions;

    public function handle(User $user, Request $request): void
    {
        if ($request->boolean('remove_picture') || $request->hasFile('profile_picture')) {
            $this->executeTransaction(function () use ($user, $request) {
                $this->deleteOldPicture($user);
                $path = $request->hasFile('profile_picture') ? $request->file('profile_picture')->store('profile-pictures', 'public') : null;
                $user->update(['profile_picture' => $path]);

                Log::info("Profile picture updated for User ID: {$user->user_id}");
            }, 'Failed to update profile picture', ['user_id' => $user->user_id]);
        }
    }

    protected function deleteOldPicture(User $user): void
    {
        $currentPath = $user->profile_picture;

        if ($currentPath) {
            Storage::disk('public')->delete($currentPath);
        }
    }
}
