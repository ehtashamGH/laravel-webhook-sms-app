<?php

namespace Database\Seeders;

use App\Models\SmsConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SmsConfigSeeder extends Seeder
{
    public function run(): void
    {
        $configs = [
            [
                'key' => 'sms_endpoint_url',
                'value' => 'https://xyz.abc',
            ],
            [
                'key' => 'server_password',
                'value' => 'Password123#',
            ],
            [
                'key' => 'webhook_secret',
                'value' => Str::random(32),
            ],
        ];

        foreach ($configs as $config) {
            SmsConfig::create($config);
        }
    }
}
