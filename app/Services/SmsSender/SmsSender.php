<?php

namespace App\Services\SmsSender;

use App\Models\SimCard;

class SmsSender implements InterfaceSmsSender
{

    public function send(SimCard $simCard, string $message)
    {
        // commands to send a message by sms
        if (rand(0, 1)){
            //ошибка при отправке
            throw new \Exception("Error while sms sending.");
        }
    }
}
