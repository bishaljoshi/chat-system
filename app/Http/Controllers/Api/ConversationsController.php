<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ConversationService;
use App\Http\Requests\ConversationRequest;

class ConversationsController extends Controller
{
    protected $conversationService;

    public function __construct(ConversationService $conversationService)
    {
        Auth::loginUsingId(5);
        $this->conversationService = $conversationService;
    }

    /**
     * Get all conversations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $conversations = $this->conversationService->conversations();

        return response()->json([
            'success' => true,
            'message' => 'Conversations fetched successfully',
            'data' => $conversations,
        ]);
    }

    /**
     * Store a newly created conversation.
     *
     * @param  ConversationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $result = $this->conversationService->createNewConversation($request->all());

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Failed to create conversation',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Conversation created successfully',
            'data' => $result['data'] ?? null,
        ], 201);
    }

    /**
     * Send a message in a conversation.
     *
     * @param  ConversationRequest  $request
     * @param  int  $conversation_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(ConversationRequest $request, $conversation_id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $result = $this->conversationService->replyToMessage($request->all(), $conversation_id);

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Failed to send message',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $result['data'] ?? null,
        ]);
    }

    /**
     * Get messages from a specific conversation.
     *
     * @param  int  $conversation_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages($conversation_id)
    {
        $result = $this->conversationService->getMessages($conversation_id);

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Failed to fetch messages',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Messages retrieved successfully',
            'data' => $result['data'] ?? [],
        ]);
    }
}
