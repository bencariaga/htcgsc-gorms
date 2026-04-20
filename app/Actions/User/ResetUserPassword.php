<?php

namespace App\Actions\User;

use App\{Contracts\ResetsUserPassword, Data\PasswordResetData};
use App\Models\{Person, User};
use Illuminate\Support\Facades\{DB, Hash, Log};
use Throwable;

class ResetUserPassword implements ResetsUserPassword
{
    public function execute(PasswordResetData $data): bool
    {
        return DB::transaction(function () use ($data) {
            try {
                $person = Person::where('email_address', $data->identifier)->orWhere('phone_number', $data->identifier)->first();

                if (!$person) {
                    return false;
                }

                $user = User::where('person_id', $person->person_id)->first();

                if (!$user) {
                    return false;
                }

                $updated = $user->update(['password' => Hash::make($data->newPassword)]);

                DB::commit();

                return $updated;
            } catch (Throwable $e) {
                DB::rollBack();
                Log::error('Password Reset Failed: ' . $e->getMessage(), ['id' => $data->identifier]);

                return false;
            }
        });
    }
}
