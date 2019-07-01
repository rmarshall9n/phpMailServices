<?php

namespace App;

use App\Contact;

class Mail
{
    protected $mailService;

    public function __construct($config)
    {
        $config = $config[$config['type']];
        $service = $config['fqn'];

        $this->mailService = new $service($config);
    }

    public function to($email, $name = null): Mail
    {
        $this->toOne($email, $name);

        return $this;
    }

    public function toOne($email, $name = null): Mail
    {
        $this->mailService->to((new Contact($email, $name)));

        return $this;
    }

    public function toMany($recipients): Mail
    {
        $contacts = [];
        foreach ($recipients as $recipient) {
            $email = is_string($recipient) ? $recipient : (isset($recipient['email']) ? $recipient['email'] : null);
            $name = isset($recipient['name']) ? $recipient['name'] : null;

            $contacts[] = new Contact($email, $name);
        }

        $this->mailService->to(...$contacts);

        return $this;
    }

    public function from($email, $name = null): Mail
    {
        $this->mailService->from((new Contact($email, $name)));

        return $this;
    }

    public function __call($function, $arguments)
    {
        if (is_callable([$this->mailService, $function])) {
            $res = call_user_func([$this->mailService, $function], ...$arguments);

            return is_null($res) ? $this : $res;
        }
    }
}
