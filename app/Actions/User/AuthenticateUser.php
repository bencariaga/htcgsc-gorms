<?php

namespace App\Actions\User;

use App\{Contracts\AuthenticatesUser, Data\AuthenticateUserData};
use App\{Models\User, Services\Miscellaneous\OTPService};
use Illuminate\Support\Facades\{DB, Log, Session};
use Throwable;

class AuthenticateUser implements AuthenticatesUser
{
    public function execute(AuthenticateUserData $data): ?string
    {
        return DB::transaction(function () use ($data) {
            $method = fn ($q) => $q->whereAny(['email_address', 'phone_number'], $data->identifier);

            try {
                $user = User::with('person')->whereRelation('person', $method)->firstOrFail();
                app(OTPService::class)->generateAndSend($user, $data->identifier);
                Session::put(['otp_email' => $data->identifier, 'otp_remember' => $data->remember]);

                return null;
            } catch (Throwable $e) {
                Log::error("Authentication Action Failed: {$e->getMessage()}", ['identifier' => $data->identifier, 'exception' => $e]);

                return 'A system error occurred during authentication.';
            }
        });
    }
}
