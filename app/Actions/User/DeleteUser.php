<?php

namespace App\Actions\User;

use App\{Exceptions\NoInternetConnectionException, Models\User};
use App\Services\Miscellaneous\{MailService, TextBeeService};
use App\Traits\Concerns\ManagesTransactions;
use Illuminate\Support\Facades\{Log, Validator};

class DeleteUser
{
    use ManagesTransactions;

    public function handle(int $userId): void
    {
        $this->executeTransaction(function () use ($userId) {
            $user = User::with('person')->findOrFail($userId);
            $person = $user->person;
            $email = $person->email_address;

            if ($this->isEmailValid($email)) {
                app(MailService::class)->sendAccountNotice($user, 'deletion');
            }

            if ($person->phone_number) {
                try {
                    $message = "Your account \"{$person->full_name}\" has been deleted by the HTCGSC-GORMS administrator. Your account does not exist in the system anymore. Please contact the administrator for more details and other clarifications.";
                    app(TextBeeService::class)->sendSms([$person->phone_number], $message);
                } catch (NoInternetConnectionException) {
                    Log::warning("SMS notification failed for user {$userId} due to connection issues.");
                }
            }

            $user->delete();
            $person->delete();

            Log::info("User and associated person record deleted successfully for User ID: {$userId}");
        }, "Failed to delete user record", ['user_id' => $userId]);
    }

    protected function isEmailValid(?string $email): bool
    {
        return !Validator::make(['email' => $email], ['email' => ['required', 'email:rfc,dns']])->fails();
    }
}
