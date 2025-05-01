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
            $table->foreignId('owner_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('category');
            $table->string('sub_category')->nullable();
            $table->string('sub_sub_category')->nullable();
            $table->string('country')->nullable();
            $table->string('zone_name');
            $table->string('governorate_name');
            $table->string('city_name');
            $table->string('district_name');
            $table->string('location');
            $table->decimal('size', 8, 2); // e.g., 123.45
            $table->json('facilities'); // Stores JSON data
            $table->integer('rooms');
            $table->integer('no_of_single_beds');
            $table->integer('no_of_master_beds');
            $table->boolean('pool')->default(false);
            $table->decimal('pool_size', 8, 2)->nullable(); // e.g., 20.00
            $table->json('kitchen'); // Stores JSON data
            $table->integer('table_chairs');
            $table->integer('bathrooms');
            $table->json('bathroom_facilities'); // Stores JSON data
            $table->json('additional_facilities'); // Stores JSON data
            $table->json('advantages'); // Stores JSON data
            $table->text('description')->nullable();
            $table->json('image'); // URL or path to the image
            $table->json('rooms_images')->nullable(); // URL or path to the rooms images
            $table->json('kitchen_images')->nullable(); // URL or path to the kitchen images
            $table->json('pool_images')->nullable(); // URL or path to the pool images
            $table->json('bathroom_images')->nullable(); // URL or path to the bathroom images
            $table->json('building_images')->nullable(); // URL or path to the building images
            $table->json('facilities_images')->nullable(); // URL or path to the facilities images
            $table->json('additional_images')->nullable(); // URL or path to the additional images
            $table->string('status')->default('available');
            $table->decimal('price', 10, 2)->nullable(); // e.g., 9999.99
            $table->string('request_status')->default('pending');
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
