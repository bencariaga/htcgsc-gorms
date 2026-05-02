<?php

namespace App\Actions\User;

use App\{Contracts\AuthenticatesUser, Data\AuthenticateUserData, Models\User};
use App\{Services\Miscellaneous\OTPService, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\Facades\{Log, Session};

class AuthenticateUser implements AuthenticatesUser
{
    use ManagesTransactions;

    public function execute(AuthenticateUserData $data): ?string
    {
        return $this->executeTransaction(function () use ($data) {
            $method = fn ($q) => $q->whereAny(['email_address', 'phone_number'], $data->identifier);

            $user = User::with('person')->whereRelation('person', $method)->firstOrFail();

            app(OTPService::class)->generateAndSend($user, $data->identifier);

            Session::put(['otp_email' => $data->identifier, 'otp_remember' => $data->remember]);

            Log::info("OTP generated and sent for authentication attempt: {$data->identifier}");

            return null;
        }, 'Authentication Action Failed', ['identifier' => $data->identifier]);
    }
}
