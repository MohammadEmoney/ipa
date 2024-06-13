<?php

namespace App\Traits;

use App\Services\SmsService;

trait SmsTrait
{
    public function sendVerificationCode($mobile, $name, $code)
    {
        $smsService = new SmsService($mobile);
        return $smsService->sendVerificationCode($name, $code);
    }
}
