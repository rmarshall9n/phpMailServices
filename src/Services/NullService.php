<?php

namespace App\Services;

use App\Contact;
use App\Contracts\MailServiceInterface;

class NullService implements MailServiceInterface
{
    public function getService()
    {
        return;
    }

    public function to(Contact ...$to): void
    {
        return;
    }

    public function from(Contact $from): void
    {
        return;
    }

    public function subject(string $subject): void
    {
        return;
    }

    public function content(string $content): void
    {
        return;
    }

    public function send()
    {
        return [
            'sent_via' => null,
        ];
    }
}
