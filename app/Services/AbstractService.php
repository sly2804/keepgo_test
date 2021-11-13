<?php

namespace App\Services;

use App\Models\Account;

class AbstractService
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }
}
