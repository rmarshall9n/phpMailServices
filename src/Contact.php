<?php

namespace App;

class Contact
{
    public $name;
    public $email;

    public function __construct(string $email, ?string $name = '')
    {
        $this->email = $email;
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
