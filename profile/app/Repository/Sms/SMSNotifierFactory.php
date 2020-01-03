<?php

namespace App\Repository\Sms;

class SMSNotifierFactory implements NotifierFactory
{

    protected $phoneNumbers;
    protected $message;

    /**
     * @param array|string $phoneNumbers
     * @param string $message
     */
    public function __construct($phoneNumbers, string $message)
    {
        $this->phoneNumbers = is_string($phoneNumbers) ? [$phoneNumbers] : $phoneNumbers;
        $this->message = $message;
    }

    public function createNotifier(): Notifier
    {
        return new SMSNotifier($this->phoneNumbers, $this->message);
    }
}
