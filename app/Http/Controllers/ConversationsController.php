<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ConversationService;
use App\Http\Requests\ConversationRequest;

/**
 * Class ConversationsController
 * Handles the management of conversations in the chat system.
 */
class ConversationsController extends Controller
{
    protected $conversationService;

    public function __construct(
        ConversationService $conversationService
    ) {
        $this->conversationService = $conversationService;
    }

    /**
     * Display a listing of the conversations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $conversations = $this->conversationService->conversations();

        return view('conversations.index', compact('conversations'));
    }

    /**
     * Show the form for creating a new conversation.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('conversations.create');
    }

    /**
     * Store a newly created conversation in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ConversationRequest $request)
    {
        $result = $this->conversationService->createNewConversation($request->all());

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->route('conversations.index')->with('success', 'Conversation created successfully');
    }

    /**
     * Send a message in a conversation.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $conversation_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(ConversationRequest $request, $conversation_id)
    {
        $result = $this->conversationService->replyToMessage($request->all(), $conversation_id);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->route('conversations.messages', $conversation_id)
            ->with('success', 'Message sent successfully');
    }

    /**
     * Retrieve messages from a conversation.
     *
     * @param int $conversation_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages($conversation_id)
    {
        $result = $this->conversationService->getMessages($conversation_id);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }
        
        return view('conversations.messages', [
            'conversation_id' => $conversation_id,
            'conversations' => $result['data']
        ]);
    }
}
