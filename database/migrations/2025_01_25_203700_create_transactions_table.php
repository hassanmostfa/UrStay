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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade'); // Foreign key to owners
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['credit', 'debit', 'cash', 'transfer' , 'other' ]); // Transaction type
            $table->decimal('amount', 15, 2); // Transaction amount
            $table->string('description', 255)->nullable(); // Transaction description
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Transaction status
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
        Schema::dropIfExists('transactions');
    }
};
