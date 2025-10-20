<?php

namespace App\Http\Middleware;

use App\Models\SmsConfig;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateWebhookSecret
{
    public function handle(Request $request, Closure $next): Response
    {
        $webhookSecret = SmsConfig::get('webhook_secret');
        $requestSecret = $request->header('X-Webhook-Secret');

        if (!$webhookSecret || $requestSecret !== $webhookSecret) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid webhook secret',
            ], 403);
        }

        return $next($request);
    }
}
