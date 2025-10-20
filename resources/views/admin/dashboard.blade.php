@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h2 class="text-xl font-bold mb-2 text-blue-900">Message Templates</h2>
                <p class="text-gray-700 mb-4">Manage your SMS message templates with dynamic placeholders.</p>
                <a href="{{ route('templates.index') }}"
                    class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Manage Templates
                </a>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <h2 class="text-xl font-bold mb-2 text-green-900">SMS Configuration</h2>
                <p class="text-gray-700 mb-4">Configure your SMS endpoint URL and authentication credentials.</p>
                <a href="{{ route('config.edit') }}"
                    class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Configure SMS
                </a>
            </div>
        </div>

        <div class="mt-8 bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Webhook Endpoint</h2>

            <div class="mb-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Endpoint URL:</h3>
                <code class="bg-white border border-gray-300 px-3 py-2 rounded text-sm block overflow-x-auto">
                        POST {{ url('/api/webhook') }}
                    </code>
            </div>

            <div class="mb-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Required Headers:</h3>
                <pre class="bg-white border border-gray-300 px-3 py-2 rounded text-sm overflow-x-auto"><code>Content-Type: application/json
X-Webhook-Secret: {{ $webhookSecret }}</code></pre>
            </div>

            <div class="mb-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Example Payload:</h3>
                <pre class="bg-white border border-gray-300 px-3 py-2 rounded text-sm overflow-x-auto"><code>{
      "message_id": "booking_confirmed",
      "mobile": "07440000000",
      "customer_name": "John Smith",
      "booking_id": "BK789012",
      "tracking_link": "https://example.com/track/123"
}</code></pre>
            </div>

            <div class="mb-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">cURL Example:</h3>
                <pre class="bg-white border border-gray-300 px-3 py-2 rounded text-xs overflow-x-auto"><code>curl -X POST {{ url('/api/webhook') }} \
      -H "Content-Type: application/json" \
      -H "X-Webhook-Secret: {{ $webhookSecret }}" \
      -d '{
        "message_id": "booking_confirmed",
        "mobile": "07440000000",
        "customer_name": "John Smith",
        "booking_id": "BK789012"
}'</code></pre>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded p-3">
                <p class="text-sm text-blue-800">
                    <strong>💡 Tip:</strong> You can change your webhook secret in the
                    <a href="{{ route('config.edit') }}" class="underline font-semibold">Configuration</a> section.
                </p>
            </div>
        </div>
    </div>
@endsection