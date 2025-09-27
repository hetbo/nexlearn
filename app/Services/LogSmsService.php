<?php

namespace App\Services;

use App\Contracts\SmsProviderInterface;
use Illuminate\Support\Facades\Log;

class LogSmsService implements SmsProviderInterface
{

    public function send(string $to, string $message): bool
    {
        Log::info("--- Sending SMS ---");
        Log::info("Recipient: " . $to);
        Log::info("Message: " . $message);
        Log::info("-------------------");
        return true;
    }
}
