<?php

namespace App\Observers;

use App\{Contracts\HandlesUserEvents, Data\UserData, Models\User};
use Illuminate\Support\Facades\Log;
use Throwable;

class UserObserver implements HandlesUserEvents
{
    public function creating(User $user): void
    {
        try {
            if (request()->hasFile('form.profilePicture')) {
                $user->profile_picture = request()->file('form.profilePicture')->store('profile-pictures', 'public');
            }

            Log::info('User created.', UserData::fromModel($user)->toArray());
        } catch (Throwable $e) {
            Log::error("User upload failed: {$e->getMessage()}");
        }
    }
}
