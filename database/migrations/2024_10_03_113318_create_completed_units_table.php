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
        Schema::create('completed_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('owner_id')->constrained()->onDelete('cascade');
            $table->decimal('saturday_price', 10, 2);
            $table->decimal('sunday_price', 10, 2);
            $table->decimal('monday_price', 10, 2);
            $table->decimal('tuesday_price', 10, 2);
            $table->decimal('wednesday_price', 10, 2);
            $table->decimal('thursday_price', 10, 2);
            $table->decimal('friday_price', 10, 2);
            $table->boolean('availability_of_booking');
            $table->boolean('negotiable_price');
            $table->string('booking_status');
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
        Schema::dropIfExists('completed_units');
    }
};
