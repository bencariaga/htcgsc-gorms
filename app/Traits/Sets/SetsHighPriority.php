<?php

namespace App\Traits\Sets;

use Symfony\Component\Mime\Email;

trait SetsHighPriority
{
    protected function highPriorityHeaders(): array
    {
        return [
            function (Email $message) {
                $message->getHeaders()->addTextHeader('X-Priority', '1 (Highest)');
                $message->getHeaders()->addTextHeader('X-MSMail-Priority', 'High');
                $message->getHeaders()->addTextHeader('Importance', 'high');
            },
        ];
    }
}
