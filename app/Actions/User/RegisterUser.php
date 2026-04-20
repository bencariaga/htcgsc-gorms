<?php

namespace App\Actions\User;

use App\{Contracts\RegistersUser, Data\UserRegistrationData};
use App\Enums\{AccountStatus, PersonType};
use App\Models\{Person, User};
use Illuminate\Support\Facades\{DB, Hash, Log};
use Throwable;

class RegisterUser implements RegistersUser
{
    public function execute(UserRegistrationData $data): void
    {
        DB::beginTransaction();

        try {
            $person = Person::create([
                'type' => PersonType::Employee,
                'last_name' => $data->lastName,
                'first_name' => $data->firstName,
                'middle_name' => $data->middleName,
                'suffix' => $data->suffix ?: null,
                'email_address' => $data->email,
                'phone_number' => $data->phoneNumber,
            ]);

            User::create([
                'person_id' => $person->person_id,
                'password' => Hash::make($data->password),
                'account_status' => AccountStatus::Inactive,
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("User registration failed: {$e->getMessage()}", ['exception' => $e]);
            throw $e;
        }
    }
}
