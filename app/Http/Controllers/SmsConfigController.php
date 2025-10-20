<?php

namespace App\Http\Controllers;

use App\Models\SmsConfig;
use Illuminate\Http\Request;

class SmsConfigController extends Controller
{
    public function edit()
    {
        $smsEndpointUrl = SmsConfig::get('sms_endpoint_url', 'https://xyz.abc');
        $serverPassword = SmsConfig::get('server_password', 'Password123#');
        $webhookSecret = SmsConfig::get('webhook_secret', '');

        return view('admin.config.edit', compact('smsEndpointUrl', 'serverPassword', 'webhookSecret'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'sms_endpoint_url' => 'required|url',
            'server_password' => 'required|string',
            'webhook_secret' => 'required|string',
        ]);

        SmsConfig::set('sms_endpoint_url', $validated['sms_endpoint_url']);
        SmsConfig::set('server_password', $validated['server_password']);
        SmsConfig::set('webhook_secret', $validated['webhook_secret']);

        return redirect()->route('config.edit')
            ->with('success', 'Configuration updated successfully.');
    }
}
