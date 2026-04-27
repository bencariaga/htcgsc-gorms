<?php

namespace App\Actions\Profile;

use App\Models\User;
use App\Traits\Miscellaneous\ManagesTransactions;
use Illuminate\Support\Facades\Log;

class UpdateProfileBasicInfo
{
    use ManagesTransactions;

    public function handle(User $user, array $data): void
    {
        $this->executeTransaction(function () use ($user, $data) {
            /** @var mixed $person */
            $person = $user->person()->firstOrFail();

            $person->update([
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'] ?: null,
                'suffix' => $data['suffix'] ?: null,
                'email_address' => $data['email_address'] ?? $person->email_address,
                'phone_number' => $data['phone_number'] ?? $person->phone_number,
            ]);

            Log::info("Basic profile info updated successfully for User ID: {$user->user_id}");
        }, 'Failed to update basic profile info', ['user_id' => $user->user_id]);
    }
}
