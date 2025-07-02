<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessagesOutbox extends Model
{
    protected $table = 'messages_outbox';

    protected $fillable = [
        'message_id',
        'delivered'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
