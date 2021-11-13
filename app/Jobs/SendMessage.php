<?php

namespace App\Jobs;

use App\Models\Account;
use App\Models\SimCard;
use App\Services\SmsSender\InterfaceSmsSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sender;
    protected $simCard;
    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(InterfaceSmsSender $sender, SimCard $simCard, string $message)
    {
        $this->sender = $sender;
        $this->simCard = $simCard;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if ($this->simCard->isActive()) {
            try {
                $this->sender->send($this->simCard, $this->message);
            }
            catch (\Throwable $exception) {
                Log::error('Message for sim card ' . $this->simCard->getIccid() . ' has not been sent! Error: ' . $exception->getMessage());
            }
            Log::info('Message for sim card ' . $this->simCard->getIccid() . ' was successfully sent!');

        }
        else {
            Log::info('Sim card ' . $this->simCard->getIccid() . ' not active. Message not send.');
        }
    }
}
