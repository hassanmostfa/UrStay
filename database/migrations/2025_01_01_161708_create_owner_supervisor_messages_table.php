<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_supervisor_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_room_id')->constrained('owner_supervisor_chat_rooms')->onDelete('cascade');
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_type'); // Will store either 'App\Models\Owner' or 'App\Models\Supervisor'
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owner_supervisor_messages');
    }
};
