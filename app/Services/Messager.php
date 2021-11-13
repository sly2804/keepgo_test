<?php

namespace App\Services;

use App\Models\Account;

class Messager extends AbstractService
{
    public function makeMessage($template)
    {
        return strtr($template, [
            '{{user_name}}' => $this->account->getUserName(),
        ]);
    }
}
