<?php
use App\Http\Controllers\Api\ConversationsController;

Route::prefix('')->group(function () {
    Route::get('/conversations', [ConversationsController::class, 'index']);
    Route::post('/conversations', [ConversationsController::class, 'store']);
    Route::post('/conversations/{conversation_id}/messages', [ConversationsController::class, 'sendMessage']);
    Route::get('/conversations/{conversation_id}/messages', [ConversationsController::class, 'getMessages']);
});
