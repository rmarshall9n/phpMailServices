<?php

namespace App\Services;

use App\Contact;
use App\Contracts\MailServiceInterface;
use Services\MailGun\MailGun;

class MailGunService implements MailServiceInterface
{
    protected $service;

    private $api_key;

    public function __construct($config)
    {
        $this->api_key = $config['api_key'];
    }

    public function getService()
    {
        if (is_null($this->service)) {
            $this->service = new MailGun($this->api_key);
        }

        return $this->service;
    }

    public function to(Contact ...$to): void
    {
        $this->getService()->doTo(
            $this->mapRecipients($to)
        );
    }

    public function from(Contact $from): void
    {
        $this->getService()->doFrom($from->toArray());
    }

    public function subject(string $subject): void
    {
        $this->getService()->doSubject($subject);
    }

    public function content(string $content): void
    {
        $this->getService()->doContent($content);
    }

    public function send()
    {
        return $this->getService()->doSend();
    }

    protected function mapRecipients(array $recipients): array
    {
        return array_map(function ($r) {
            return $r->toArray();
        }, $recipients);
    }

    public function __call($function, $arguments)
    {
        if (is_callable([$this->service, $function])) {
            $res = call_user_func([$this->service, $function], ...$arguments);

            return is_null($res) ? $this : $res;
        }
    }
}
