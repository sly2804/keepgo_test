<?php

namespace App\Services;

use App\Jobs\SendMessage;
use App\Models\Account;
use App\Services\SmsSender\SmsSender;
use Illuminate\Support\Facades\Log;

class Sender extends AbstractService
{
    //принимает шаблон сообщения
    //в шаблоне необходимо использовать {{user_name}} для подстановки имени пользователя
    public function sendMessageToAllLine(string $templateMessage)
    {
        $messager = new Messager($this->account);
        $message = $messager->makeMessage($templateMessage);
        $simCards = $this->account->simCards;
        if (count($simCards)) {
            foreach ($simCards as $simCard) {
                dispatch(new SendMessage(new SmsSender, $simCard, $message));
            }
        }
        else {
            Log::warning('Account has not sim cards!');
        }
    }


}
