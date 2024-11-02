<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $apiKey = env('SMS_API_KEY');
            $lineNumber = env('SMS_LINE_NUMBER');
            $username = env('SMS_USERNAME');
            $templateId = env('SMS_TEMPLATE_ID');
            $mainUrl = "https://api.sms.ir/v1/line";
            // $requestBody = [
            //     "lineNumber" => $this->lineNumber,
            //     "messageText" => $this->messageText,
            //     "mobiles" => $this->mobiles,
            // ];
            // dd($requestBody);
            $send = Http::withHeaders([
                'accept' => 'text/plain',
                'x-api-key' => $apiKey,
                'Content-Type' => 'application/json'
            ])->get($mainUrl);
            Log::info($send->json());
            $result = $send->body();
            dump($result);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
}
