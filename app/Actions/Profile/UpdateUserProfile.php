<?php

namespace App\Actions\Profile;

use App\{Actions\Person\UpdatePersonInfo, Traits\Miscellaneous\ManagesTransactions};
use App\Models\{Person, User};
use Illuminate\Support\Facades\Log;

class UpdateUserProfile
{
    use ManagesTransactions;

    public function handle(User $user, array $data): void
    {
        $this->executeTransaction(function () use ($user, $data) {
            if (!$user->relationLoaded('person')) {
                $user->setRelation('person', Person::find($user->person_id));
            }

            $person = $user->person;

            if (!$person) {
                Log::error("Attempted to update profile for user without person record. User ID: {$user->user_id}");

                return;
            }

            app(UpdatePersonInfo::class)->handle($person, $data);
            Log::info("User profile info updated successfully for User ID: {$user->user_id}");
        }, 'Failed to update user profile info', ['user_id' => $user->user_id]);
    }
}
