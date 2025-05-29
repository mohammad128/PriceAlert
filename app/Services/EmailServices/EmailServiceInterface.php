<?php

namespace App\Services\EmailServices;

interface EmailServiceInterface
{
    public function sendMail(string $receiver, string $message, string $uniqueKey);
}
