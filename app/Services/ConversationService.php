<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Services\MessageService;
use App\Services\UserService;

class ConversationService
{
    protected $messageService;
    protected $userService;

    public function __construct(
        MessageService $messageService,
        UserService $userService
    ) {
        $this->messageService = $messageService;
        $this->userService = $userService;
    }

    public function conversations()
    {
        $conversations = Conversation::with(['user', 'messages']);

        // if customer is logged in, show only the conversations related to that customer
        if (auth()->user()->is_agent === 0) {
            $conversations = $conversations->where('customer_id', auth()->user()->id);
        }

        return $conversations->get();
    }

    public function create(Array $attributes, User $agent)
    {
        $data['content'] = $attributes['content'];
        $data['agent_id'] = $agent->id;
        $data['customer_id'] = $attributes['customer_id'];
        $data['status'] = 'open';

        return Conversation::create($data);
    }

    public function createNewConversation(Array $attributes)
    {
        // Find an available agent
        $agent = $this->userService->agent();
        if (!$agent) {
            return ['success' => false, 'message' => 'No agent available.'];
        }

        // Create a new conversation
        $conversation = $this->create($attributes, $agent);
        if (!$conversation) {
            return ['success' => false, 'message' => 'Failed to create conversation.'];
        }

        // Create the first message in the conversation
        $message = $this->messageService->create($attributes, $conversation);
        if (!$message) {
            return ['success' => false, 'message' => 'Failed to send message.'];
        }

        // Returns `conversation_id` and assigned agent info
        return [
            'success' => true,
            'message' => 'Conversation created successfully',
            'data' => [
                'conversation_id' => $conversation->id,
                'agent' => $agent,
            ]
        ];
    }

    public function replyToMessage(Array $attributes, $conversation_id)
    {
        $conversation = Conversation::with(['user', 'messages'])->findOrFail($conversation_id);

        $data = [
            'conversation_id'   => $conversation->id,
            'sender_id'         => $attributes['customer_id'],
            'content'           => $attributes['content'],
        ];
        $message = Message::create($data);

        if (!$message) {
            return ['success' => false, 'message' => 'Failed to send message.'];
        }

        return [
            'success' => true,
            'message' => 'Replied to message successfully',
            'data' => [
                'message_id' => $message->id,
                'timestamp' => $message->created_at->toDateTimeString(),
            ],
        ];
    }

    public function getMessages($conversation_id)
    {
        $conversation = Conversation::with(['user','messages'])->findOrFail($conversation_id);

        if (auth()->user()->is_agent === 0 && $conversation->customer_id !== auth()->user()->id) {
            return ['success' => false, 'message' => 'Unauthorized access'];
        }

        if (auth()->user()->is_agent === 0) {
            $conversation = $conversation->messages->where('sender_id', auth()->user()->id);
        }

        return [
            'success' => true,
            'message' => 'Fetch messages successfully',
            'data' => $conversation,
        ];
    }
}
