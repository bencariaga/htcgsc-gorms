<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserObserver
{
    public function creating(User $user): void
    {
        try {
            if (request()->hasFile('form.profilePicture')) {
                $user->profile_picture = request()->file('form.profilePicture')->store('profile-pictures', 'public');
            }
        } catch (Throwable $e) {
            Log::error("User upload failed: {$e->getMessage()}");
        }
    }
}
