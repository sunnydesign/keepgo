<?php

namespace App\Jobs;

use App\Models\SimCard;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\SendSms as SendSmsService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SendSms implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected SimCard $simCard;

    protected string $message;

    protected SendSmsService $sendSmsService;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * Calculate the number of seconds to wait before retrying the job.
     *
     * @return array
     */
    public function backoff()
    {
        return [1, 2, 3];
    }

    /**
     * @param SimCard $simCard
     * @param string $message
     *
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(SimCard $simCard, string $message)
    {
        $this->sendSmsService = app()->get(SendSmsService::class);
        $this->simCard = $simCard;
        $this->message = $message;
    }

    /**
     * Common handler with user setter.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendSmsService->send($this->simCard, $this->message);
    }

}
