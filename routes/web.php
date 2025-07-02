<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ConversationsController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// require __DIR__.'/api.php';
// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('conversations.index');
    })->name('dashboard');
    Route::get('/conversations', [ConversationsController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/create', [ConversationsController::class, 'create'])->name('conversations.create');
    Route::post('/conversations', [ConversationsController::class, 'store'])->name('conversations.store');
    Route::get('/conversations/{conversation_id}/messages', [ConversationsController::class, 'getMessages'])->name('conversations.messages');
    Route::post('/conversations/{conversation_id}/messages', [ConversationsController::class, 'sendMessage'])->name('conversations.sendMessage');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
});
