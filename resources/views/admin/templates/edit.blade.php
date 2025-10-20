@extends('layouts.app')

@section('title', 'Edit Message Template')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-6">Edit Template</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('templates.update', $template) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="message_id" class="block text-gray-700 text-sm font-bold mb-2">
                    Message ID <span class="text-red-500">*</span>
                </label>
                <input type="text" name="message_id" id="message_id" value="{{ old('message_id', $template->message_id) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                <p class="text-gray-600 text-xs mt-1">A unique identifier for this template</p>
            </div>

            <div class="mb-4">
                <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">
                    Subject (Optional)
                </label>
                <input type="text" name="subject" id="subject" value="{{ old('subject', $template->subject) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">
                    Message Body <span class="text-red-500">*</span>
                </label>
                <textarea name="body" id="body" rows="6"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>{{ old('body', $template->body) }}</textarea>
                <p class="text-gray-600 text-xs mt-1">Use placeholders like {customer_name}, {booking_id}, {tracking_link},
                    {mobile}, etc.</p>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <h3 class="font-bold text-sm mb-2">Available Placeholders:</h3>
                <div class="text-sm text-gray-700">
                    <code class="bg-white px-2 py-1 rounded">{customer_name}</code>
                    <code class="bg-white px-2 py-1 rounded ml-2">{mobile}</code>
                    <code class="bg-white px-2 py-1 rounded ml-2">{booking_id}</code>
                    <code class="bg-white px-2 py-1 rounded ml-2">{tracking_link}</code>
                    <p class="mt-2 text-xs">You can use any placeholder that will be provided in the webhook payload.</p>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('templates.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Template
                </button>
            </div>
        </form>
    </div>
@endsection