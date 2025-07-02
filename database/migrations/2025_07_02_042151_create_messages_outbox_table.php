<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages_outbox', function (Blueprint $table) {
            $table->id();
            $table->integer('message_id'); // ID of the message that is being sent
            $table->boolean('delivered')->default(false); // Status of the message
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages_outbox');
    }
};
