<?php

namespace App\Actions\User;

use App\{Contracts\RegistersUser, Data\UserRegistrationData, Traits\Miscellaneous\ManagesTransactions};
use App\Enums\{AccountStatus, PersonType};
use App\Models\{Person, User};
use Illuminate\Support\Facades\{Hash, Log};

class RegisterUser implements RegistersUser
{
    use ManagesTransactions;

    public function execute(UserRegistrationData $data): void
    {
        $this->executeTransaction(function () use ($data) {
            $person = Person::create([
                'type' => PersonType::Employee,
                'last_name' => $data->lastName,
                'first_name' => $data->firstName,
                'middle_name' => $data->middleName,
                'suffix' => $data->suffix ?: null,
                'email_address' => $data->email,
                'phone_number' => $data->phoneNumber,
            ]);

            User::create(['person_id' => $person->person_id, 'password' => Hash::make($data->password), 'account_status' => AccountStatus::Inactive]);

            Log::info("User successfully registered for Email: {$data->email}");
        }, 'User registration failed', ['email' => $data->email]);
    }
}
