<?php

namespace App\Actions\User;

use App\{Contracts\ResetsUserPassword, Data\PasswordResetData, Traits\Concerns\ManagesTransactions};
use App\Models\{Person, User};
use Illuminate\Support\Facades\{Hash, Log};

class ResetUserPassword implements ResetsUserPassword
{
    use ManagesTransactions;

    public function execute(PasswordResetData $data): bool
    {
        return $this->executeTransaction(function () use ($data) {
            $person = Person::where('email_address', $data->identifier)
                ->orWhere('phone_number', $data->identifier)
                ->first();

            if (!$person) {
                Log::warning("Password reset attempted for non-existent person: {$data->identifier}");

                return false;
            }

            $user = User::where('person_id', $person->person_id)->first();

            if (!$user) {
                Log::warning("Password reset attempted for person without user record: {$data->identifier}");

                return false;
            }

            $updated = $user->update(['password' => Hash::make($data->newPassword)]);

            if ($updated) {
                Log::info("Password reset successful for User ID: {$user->user_id}");
            }

            return $updated;
        }, 'Password Reset Failed', ['identifier' => $data->identifier]);
    }
}
