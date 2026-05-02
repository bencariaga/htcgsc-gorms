<?php

namespace App\Actions\Mail;

use App\{Exceptions\NoInternetConnectionException, Models\User};
use Illuminate\Support\{Facades\Mail, Reflector};
use Symfony\Component\Mailer\Exception\TransportException;

class SendAccountNoticeMail
{
    public function handle(User $user, string $type): void
    {
        $suffix = str($type)->studly();
        $className = "\App\\Mail\\NoticeAccount{$suffix}";

        if (Reflector::isCallable($className)) {
            try {
                Mail::to($user->person->email_address)->send(new $className($user));
            } catch (TransportException) {
                throw new NoInternetConnectionException;
            }
        }
    }
}
