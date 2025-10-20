<?php

namespace App\Http\Controllers;

use App\Models\MessageTemplate;
use App\Services\SmsService;
use App\Services\TemplateProcessor;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    protected $smsService;
    protected $templateProcessor;

    public function __construct(SmsService $smsService, TemplateProcessor $templateProcessor)
    {
        $this->smsService = $smsService;
        $this->templateProcessor = $templateProcessor;
    }

    public function receive(Request $request)
    {
        $data = $request->all();

        if (!isset($data['message_id']) || !isset($data['mobile'])) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields: message_id and mobile',
            ], 400);
        }

        $template = MessageTemplate::where('message_id', $data['message_id'])->first();

        if (!$template) {
            return response()->json([
                'success' => false,
                'message' => 'Template not found for message_id: ' . $data['message_id'],
            ], 404);
        }

        $processedMessage = $this->templateProcessor->process($template, $data);
        $sent = $this->smsService->send($data['mobile'], $processedMessage);

        if ($sent) {
            return response()->json([
                'success' => true,
                'message' => 'SMS sent successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send SMS',
            ], 500);
        }
    }
}
