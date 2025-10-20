<?php

namespace App\Http\Controllers;

use App\Models\SmsConfig;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $webhookSecret = SmsConfig::get('webhook_secret', 'your-webhook-secret');

        return view('admin.dashboard', compact('webhookSecret'));
    }
}
