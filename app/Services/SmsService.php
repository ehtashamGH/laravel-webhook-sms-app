<?php

namespace App\Services;

use App\Models\SmsConfig;
use Illuminate\Support\Facades\Http;

class SmsService
{
    public function send(string $number, string $message): bool
    {
        $endpoint = SmsConfig::get('sms_endpoint_url', 'https://xyz.abc');
        $password = SmsConfig::get('server_password', 'Password123#');

        $url = $endpoint . '?' . http_build_query([
            'number' => $number,
            'msg' => $message,
            'server_password' => $password,
        ]);

        try {
            $response = Http::get($url);
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}

