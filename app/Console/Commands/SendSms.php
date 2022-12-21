<?php

namespace App\Console\Commands;

use App\Models\Account;
use Illuminate\Console\Command;
use App\Jobs\SendSms as SendSmsJob;
use Throwable;

class SendSms extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send-sms {accountId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sms.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            /** @var Account $account */
            $account = Account::findOrFail($this->argument('accountId'));

            $activeSimCards = $account->simCards()->where('is_active', '=', true)->get();

            foreach ($activeSimCards as $activeSimCard) {
                $message = "Hello {$account->name}. Don't worry. This is test message.";

                SendSmsJob::dispatch($activeSimCard, $message);
            }

            return Command::SUCCESS;
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }
    }

}
