<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function create($attributes, $conversation)
    {
        $data = [
            'conversation_id' => $conversation->id,
            'sender_id' => $attributes['customer_id'],
            'content' => $attributes['content'],
        ];

        return Message::create($data);
    }
}
