<?php

namespace Services\Mandrill;

class Mandrill
{
    private $to;
    private $from;
    private $subject;
    private $content;
    private $api_key;

    public function __construct($key)
    {
        $this->api_key = $key;
    }

    public function doTo($to)
    {
        $this->to = $to;
    }

    public function doFrom($from)
    {
        $this->from = $from;
    }

    public function doSubject($subject)
    {
        $this->subject = $subject;
    }

    public function doContent($content)
    {
        $this->content = $content;
    }

    public function doSend()
    {
        return [
            'sent_via' => 'Mandrill',
            'key' => $this->api_key,
            'to' => $this->to,
            'from' => $this->from,
            'subject' => $this->subject,
            'content' => $this->content,
        ];
    }
}
