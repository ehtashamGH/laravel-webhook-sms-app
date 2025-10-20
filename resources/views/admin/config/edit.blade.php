@extends('layouts.app')

@section('title', 'SMS Configuration')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-6">SMS Configuration</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('config.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="sms_endpoint_url" class="block text-gray-700 text-sm font-bold mb-2">
                    SMS Endpoint URL <span class="text-red-500">*</span>
                </label>
                <input type="url" name="sms_endpoint_url" id="sms_endpoint_url"
                    value="{{ old('sms_endpoint_url', $smsEndpointUrl) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required placeholder="https://xyz.abc">
                <p class="text-gray-600 text-xs mt-1">The base URL for your SMS service</p>
            </div>

            <div class="mb-4">
                <label for="server_password" class="block text-gray-700 text-sm font-bold mb-2">
                    Server Password <span class="text-red-500">*</span>
                </label>
                <input type="text" name="server_password" id="server_password"
                    value="{{ old('server_password', $serverPassword) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required placeholder="Password123#">
                <p class="text-gray-600 text-xs mt-1">The server password for SMS authentication</p>
            </div>

            <div class="mb-4">
                <label for="webhook_secret" class="block text-gray-700 text-sm font-bold mb-2">
                    Webhook Secret <span class="text-red-500">*</span>
                </label>
                <input type="text" name="webhook_secret" id="webhook_secret"
                    value="{{ old('webhook_secret', $webhookSecret) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required placeholder="your-secret-key-here">
                <p class="text-gray-600 text-xs mt-1">This secret must be included in the X-Webhook-Secret header when
                    calling the webhook endpoint</p>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <h3 class="font-bold text-sm mb-2">Example SMS Request:</h3>
                <code class="text-xs bg-white px-2 py-1 rounded block overflow-x-auto">
                    {{ $smsEndpointUrl }}?number=07440000000&msg=Your+message+content&server_password={{ $serverPassword }}
                </code>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Configuration
                </button>
            </div>
        </form>
    </div>
@endsection