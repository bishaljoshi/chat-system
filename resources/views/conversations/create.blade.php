@extends('layouts.master')

@section('title', 'Create Conversation')

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
                <h1 class="text-3xl font-bold text-gray-700 mb-6 border-b pb-4">Create Conversation</h1>
                
                <form action="{{ route('conversations.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                    <div class="w-full space-y-4">
                        <div>
                            <label for="content" class="block text-md font-medium text-gray-700 mb-1">Content</label>
                            <textarea
                                name="content"
                                id="content"
                                rows="4"
                                class="block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                placeholder="Enter conversation content"
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
                                Create Conversation
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
