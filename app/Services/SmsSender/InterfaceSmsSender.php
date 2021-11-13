<?php

namespace App\Services\SmsSender;

use App\Models\SimCard;

interface InterfaceSmsSender
{
    //send message
    public function send(SimCard $simCard, string $message);
}
