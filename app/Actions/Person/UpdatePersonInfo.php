<?php

namespace App\Actions\Person;

use App\{Models\Person, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\Facades\Log;

class UpdatePersonInfo
{
    use ManagesTransactions;

    public function handle(Person $person, array $data): void
    {
        $this->executeTransaction(function () use ($person, $data) {
            $person->update([
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'] ?: null,
                'suffix' => $data['suffix'] ?: null,
                'email_address' => $data['email_address'] ?? $person->email_address,
                'phone_number' => $data['phone_number'] ?? $person->phone_number,
            ]);

            Log::info('Person information has been updated.', $person->only(['full_name', 'formal_name_with_initial', 'first_name', 'email_address', 'phone_number', 'type']));
        }, 'Failed to update person info', ['person_id' => $person->person_id]);
    }
}
