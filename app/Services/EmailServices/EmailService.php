<?php

namespace App\Services\EmailServices;

use Illuminate\Support\Facades\Log;

class EmailService implements EmailServiceInterface
{
    public function sendMail(string $receiver, string $message, string $uniqueKey): void
    {
        Log::info('sent email', [
            'receiver' => $receiver,
            'message' => $message,
            'uniqueKey' => $uniqueKey,
        ]);
    }
}
