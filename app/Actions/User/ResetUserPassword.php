<?php

namespace App\Actions\User;

use App\Contracts\ResetsUserPassword;
use App\Data\PasswordResetData;
use App\Models\Person;
use App\Traits\Miscellaneous\ManagesTransactions;
use Illuminate\Support\Facades\{Hash, Log};

class ResetUserPassword implements ResetsUserPassword
{
    use ManagesTransactions;

    public function execute(PasswordResetData $data): bool
    {
        return $this->executeTransaction(function () use ($data) {
            $person = Person::where('email_address', $data->identifier)->orWhere('phone_number', $data->identifier)->first();

            if (!$person) {
                Log::warning("Password update attempted for non-existent person: {$data->identifier}");

                return false;
            }

            $user = $person->user;

            if (!$user) {
                Log::warning("Password update attempted for person without user record: {$data->identifier}");

                return false;
            }

            $updated = $user->update(['password' => Hash::make($data->newPassword)]);

            if ($updated) {
                Log::info("Password updated successfully for User ID: {$user->user_id}");
            }

            return (bool) $updated;
        }, 'Password Update Failed', ['identifier' => $data->identifier]);
    }
}
