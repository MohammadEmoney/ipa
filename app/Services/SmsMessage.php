<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsMessage
{
    protected $lines = [];
    protected $to;
    protected $name;
    protected $messageText;
    protected $mobiles;
    protected $apiKey;
    protected $lineNumber;
    protected $username;
    protected $templateId;
    protected $parameters;
    protected $mainUrl;

    public function __construct($lines = [])
    {
        $this->lines = $lines;
        $this->apiKey = env('SMS_API_KEY');
        $this->lineNumber = env('SMS_LINE_NUMBER');
        $this->username = env('SMS_USERNAME');
        $this->templateId = env('SMS_TEMPLATE_ID');
        $this->mainUrl = "https://api.sms.ir/v1/send/verify";
        $this->parameters = [
            [
                'name' => 'username',
                'value' => $this->name,
            ]
        ];

        return $this;
    }
    
    public function to($to)
    {
        $this->to = $to;

         return $this;
    }
    
    
    public function name($name)
    {
        $this->name = $name;

         return $this;
    }
    
    
    public function messageText($messageText)
    {
        $this->messageText = $messageText;

         return $this;
    }
    
    
    public function mobiles($mobiles)
    {
        $this->mobiles = $mobiles;

         return $this;
    }
    
    public function templateId($templateId)
    {
        $this->templateId = $templateId ?: env('SMS_TEMPLATE_ID');

        return $this;
    }
    
    
    public function parameters($parameters)
    {
        $this->parameters = $parameters ?: [];

        return $this;
    }
    
    public function mainUrl($url)
    {
        $this->mainUrl = $url;

        return $this;
    }

    public function line($line = '')
    {
       $this->lines[] = $line;

       return $this;
    }

    public function send() {
        if (!$this->to || !count($this->lines)) {
            throw new \Exception('SMS not correct.');
        }
        try {
            $requestBody = [
                "templateId" => $this->templateId,
                "mobile" => $this->to,
                "parameters" => $this->parameters,
            ];
            $send = Http::withHeaders([
                'accept' => 'text/plain',
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post($this->mainUrl, $requestBody);
            Log::info($send->json());
            return $send->body();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }

    public function bulkSend()
    {
        $mainUrl = "https://api.sms.ir/v1/send/bulk";
        if (!$this->messageText || !count($this->mobiles)) {
            throw new \Exception('SMS not correct.');
        }
        try {
            $requestBody = [
                "lineNumber" => $this->lineNumber,
                "messageText" => $this->messageText,
                "mobiles" => $this->mobiles,
            ];
            // dd($requestBody);
            $send = Http::withHeaders([
                'accept' => 'text/plain',
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post($mainUrl, $requestBody);
            Log::info($send->json());
            return $send->body();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
}