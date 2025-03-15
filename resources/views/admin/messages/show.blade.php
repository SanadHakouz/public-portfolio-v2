@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white border border-gray-200 rounded-lg">
    <div class="mb-6">
        <a href="{{ route('admin.messages.index') }}" class="text-blue-600 hover:text-blue-800">
            &larr; Back to Messages
        </a>
    </div>

    <div class="mb-4">
        <h2 class="text-xl font-medium text-gray-800">{{ $message->subject }}</h2>
        <div class="mt-2 text-sm text-gray-600">
            From: <strong>{{ $message->name }}</strong> &lt;{{ $message->email }}&gt;
        </div>
        <div class="mt-1 text-sm text-gray-600">
            Date: {{ $message->created_at->format('F j, Y, g:i a') }}
        </div>
    </div>

    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
        <div class="whitespace-pre-line text-gray-800">{{ $message->message }}</div>
    </div>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('admin.messages.index') }}" class="text-blue-600 hover:text-blue-800">
            Back to Messages
        </a>

        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this message?')">
                Delete Message
            </button>
        </form>
    </div>
</div>
@endsection
