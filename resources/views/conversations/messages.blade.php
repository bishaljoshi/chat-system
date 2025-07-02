@extends('layouts.master')

@section('title', 'Conversation Messages')

@section('content')
    <div class="grid grid-cols-2">
        <div class="flex">
            <h1 class="text-3xl font-bold">Messages</h1>
            <a href="{{ route('conversations.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Back</a>
        </div>
        <div class="flex items-center justify-end">
            <span>
                {{auth()->user()->name}}
                [{{ auth()->user()->is_agent === 1 ? "Agent" : "Customer" }}]
                <a href="{{ route('logout') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Logout</a>
            </span>
        </div>
    </div>

    <div id="app" class="flex items-center justify-center">
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h1 class="text-3xl font-bold text-gray-700 mb-6 border-b pb-4">Conversation Messages</h1>
                
                <div class="w-full max-w-2xl mx-auto p-4 bg-white rounded-lg shadow space-y-6 grid grid-cols-1">
                    @if ($conversations && $conversations->messages->count() > 0)
                        @foreach($conversations->messages as $message)
                            @if (auth()->user()->id === $message->sender_id)
                                <div class="w-full">
                                    <div class="w-2/4 p-4 bg-blue-50 rounded-lg shadow-sm mb-4 float-right">
                                        <p class="text-blue-800">{{ $message->content }}</p>
                                        <span class="text-xs text-blue-500">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="w-full">
                                    <div class="w-2/4 p-4 bg-gray-50 rounded-lg shadow-sm mb-4 float-left">
                                        <p class="text-gray-800">{{ $message->content }}</p>
                                        <span class="text-xs text-gray-500">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                <form action="{{ route('conversations.sendMessage', $conversation_id) }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    <input type="hidden" name="conversation_id" value="{{ $conversation_id }}">
                    <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                    <div>
                        <label for="content" class="block text-md font-medium text-gray-700 mb-1">New Message</label>
                        <textarea
                            name="content"
                            id="content"
                            rows="4"
                            class="block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                            placeholder="Enter your message here"
                        ></textarea>
                    </div>
                    <span>
                        @error('content')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </span>

                    <div>
                        <button
                            type="submit"
                            class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-1.5 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
