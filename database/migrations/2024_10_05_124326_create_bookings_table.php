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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to the users table
            $table->unsignedBigInteger('completed_unit_id'); // Foreign key to the units table
            $table->unsignedBigInteger('owner_id'); // Foreign key to the owners table
            $table->date('start_date'); // Booking start date
            $table->date('end_date'); // Booking end date
            $table->decimal('user_price', 10, 2)->nullable(); // User's proposed price, if negotiable
            $table->text('note')->nullable(); // Any notes from the user
            $table->decimal('total_price', 10, 2); // Total price for the booking
            $table->string('booking_status')->default('in_negotiation'); // Status of the booking
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('completed_unit_id')->references('id')->on('completed_units')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
