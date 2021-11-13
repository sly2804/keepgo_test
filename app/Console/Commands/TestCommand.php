<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Services\Sender;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    const NUM_SIM_CARD = 50;
    const TEMPLATE_MESSAGE = '{{user_name}}, be happy!';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:sendMessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send test message to account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $account = Account::first();
        if (!$account) {
            //заполняем базу тестовыми значениями
            $account = new Account(['user_name' => 'UserName']);
            $account->save();
            for ($simCard = 1; $simCard <= self::NUM_SIM_CARD; $simCard++) {
                $account->simCards()->create([
                    'iccid' => $simCard,
                ]);
            }
        }
        $sender = new Sender($account);
        $sender->sendMessageToAllLine(self::TEMPLATE_MESSAGE);
        $this->info('Processed!');
        $account->delete();
        return Command::SUCCESS;
    }
}
