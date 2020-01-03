<?php

namespace App\Repository\Sms;

interface NotifierFactory
{

    public function createNotifier(): Notifier;
}
