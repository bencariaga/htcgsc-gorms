<?php

namespace App\Providers;

use Illuminate\{Mail\Events\MessageSending, Support\Facades\Event, Support\ServiceProvider};
use Symfony\Component\Mime\{Address, Header\PathHeader};

class MailServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen(MessageSending::class, function (MessageSending $event) {
            $emailString = (string) config('mail.mailers.smtp.username');

            if (str($emailString)->isNotEmpty()) {
                $address = new Address($emailString);
                $event->message->getHeaders()->add(new PathHeader('Return-Path', $address));
            }
        });
    }
}
