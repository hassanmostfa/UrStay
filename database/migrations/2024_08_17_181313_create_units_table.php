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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('unit_image')->nullable();
            $table->string('unit_price');
            $table->string('unit_description'); 
            $table->string('unit_status');
            $table->string('unit_location');
            $table->string('unit_size');
            $table->string('unit_rooms');
            $table->string('unit_bathrooms');
            $table->string('unit_type');
            $table->string('owner_email');
            $table->string('owner_phone');
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
        Schema::dropIfExists('units');
    }
};
