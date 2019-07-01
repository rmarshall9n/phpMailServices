<?php

namespace App\Contracts;

use App\Contact;

interface MailServiceInterface
{
    public function getService();

    public function to(Contact ...$to): void;
    public function from(Contact $from): void;
    public function subject(string $subject): void;
    public function content(string $content): void;
    public function send();
}
