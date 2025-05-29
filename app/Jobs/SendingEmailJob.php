<?php

namespace App\Jobs;

use App\Services\EmailServices\EmailServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendingEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $receiver,
        public string $message,
        public string $uniqueKey,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $emailService = app(EmailServiceInterface::class);

        $emailService->sendMail(
            receiver: $this->receiver,
            message: $this->message,
            uniqueKey: $this->uniqueKey
        );
    }
}
