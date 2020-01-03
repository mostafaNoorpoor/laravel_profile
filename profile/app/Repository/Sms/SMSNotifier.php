<?php

namespace App\Repository\Sms;

class SMSNotifier implements Notifier
{

    protected $phoneNumbers;
    protected $message;

    public function __construct($phoneNumbers, string $message)
    {
        $this->phoneNumbers = $phoneNumbers;
        $this->message = $message;
    }

    public function send()
    {
        return true;
    }
}
