<?php

namespace App\Actions\Profile;

use App\Models\{Person, User};

class PrepareProfileUpdatedEvent
{
    public function handle(User $user): array
    {
        if (!$user->relationLoaded('person')) {
            $user->setRelation('person', Person::find($user->person_id));
        }

        $person = $user->person;

        return [
            'lastName' => $person->last_name,
            'firstName' => $person->first_name,
            'middleName' => $person->middle_name,
            'suffix' => $person->suffix?->value,
            'email' => $person->email_address,
            'phoneNumber' => $person->phone_number,
            'profilePictureUrl' => $user->profile_picture_url,
        ];
    }
}
