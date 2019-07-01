<?php

return [

    'type' => 'mandrill',

    'mandrill' => [
        'fqn' => \App\Services\MandrillService::class,
        'api_key' => 'MD12345',
    ],

    'mailgun' => [
        'fqn' => \App\Services\MailGunService::class,
        'api_key' => 'MG:12345',
    ],

    'null' => [
        'fqn' => \App\Services\NullService::class,
    ],

];
