@extends('layouts.master')

@section('title', 'Conversations')

@section('content')
    <div class="grid grid-cols-2">
        <div class="">
            <h1 class="text-3xl font-bold">Messages</h1>
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
        <div class="container py-8">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-800">Conversations</h1>
                    <a href="{{ route('conversations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">New Conversation</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-left text-gray-600 uppercase tracking-wider">
                                <th class="py-3 px-4 border-b">ID</th>
                                <th class="py-3 px-4 border-b">Agent</th>
                                <th class="py-3 px-4 border-b">Content</th>
                                <th class="py-3 px-4 border-b">Status</th>
                                <th class="py-3 px-4 border-b">Created At</th>
                                <th class="py-3 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($conversations->count() > 0)
                                @foreach($conversations as $conversation)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $conversation->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $conversation->user->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $conversation->messages->last()->content ?? 'No messages' }}</td>
                                        <td class="py-2 px-4 border-b">{{ $conversation->status }}</td>
                                        <td class="py-2 px-4 border-b">{{ $conversation->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <a href="{{ route('conversations.messages', $conversation->id) }}" class="text-blue-500 hover:underline">View Message</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="py-4 px-6 text-center text-gray-500">No conversations found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
