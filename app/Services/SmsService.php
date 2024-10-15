<?php

namespace App\Services;

use App\Enums\EnumAlertConfirmClass;
use App\Enums\EnumAlertType;
use Illuminate\Support\Facades\Http;

class SmsService
{
    private $mobile;
    private $message;

    public function __construct(string $mobile)
    {
        $this->mobile = $mobile;
    }

    function sendVerificationCode($name, $code)
    {
        try {
            $apiKey = env('SMS_API_KEY');
            $lineNumber = env('SMS_LINE_NUMBER');
            $username = env('SMS_USERNAME');
            $templateId = env('SMS_TEMPLATE_ID');
            $mainUrl = "https://api.sms.ir/v1/send/verify";
            $requestBody = [
                "templateId" => $templateId,
                "mobile" => $this->mobile,
                "parameters" => [
                    [
                        'name' => 'username',
                        'value' => "$name",
                    ],
                    [
                        'name' => 'verification-code',
                        'value' => "$code",
                    ],
                    // [
                    //     'name' => 'Code',
                    //     'value' => "$code",
                    // ],
                ],
            ];
            $send = Http::withHeaders([
                'accept' => 'text/plain',
                'x-api-key' => $apiKey,
                'Content-Type' => 'application/json'
            ])->post($mainUrl, $requestBody);
            return $send->body();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    // function sendVerificationCode($name, $code)
    // {

    //     // $normalPattern = "/sms/pattern/normal/send";
    //     // $api = $this->mainUrl . $normalPattern;
    //     // $requestBody = [
    //     //     "code" => config('ippanel.pattern.login-verification_code'),
    //     //     "sender" => config('ippanel.config.send_number'),
    //     //     "recipient" => $this->mobile,
    //     //     "variable" => [
    //     //         'name' => $name,
    //     //         'verification-code' => $code,
    //     //     ],
    //     // ];

    //     try {
    //         $apiKey = env('SMS_API_KEY');
    //         $lineNumber = env('SMS_LINE_NUMBER');
    //         $username = env('SMS_USERNAME');
    //         $templateId = env('SMS_TEMPLATE_ID');
    //         $mainUrl = "https://api.sms.ir/v1/send/verify";
    //         // $url = "https://api.sms.ir/v1/send?username=$username&password=$apiKey&line=$lineNumber&mobile={$this->mobile}&text={$this->message}";
    //         // $bulk = Http::get("http://ippanel.com:8080/?apikey={$apiKey}&fnum={$send_number}&tnum={$mobile}&{$pattern}")->json();
    //         // $send = Http::get($url);
    //         $requestBody = [
    //             "templateId" => $templateId,
    //             "mobile" => $this->mobile,
    //             "parameters" => [
    //                 // [
    //                 //     'name' => 'username',
    //                 //     'value' => $name,
    //                 // ],
    //                 // [
    //                 //     'name' => 'verification-code',
    //                 //     'value' => $code,
    //                 // ],
    //                 [
    //                     'name' => 'Code',
    //                     'value' => "$code",
    //                 ],
    //             ],
    //         ];
    //         // dd($mainUrl, $requestBody);
    //         $send = Http::withHeaders([
    //             'accept' => 'text/plain',
    //             'x-api-key' => $apiKey,
    //             'Content-Type' => 'application/json'
    //         ])->post($mainUrl, $requestBody);
    //         return $send->body();
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
}
