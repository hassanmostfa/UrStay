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
        Schema::create('pricing_mechanisms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');
            $table->string('name');
            $table->decimal('saturday_price', 10, 2);
            $table->decimal('thursday_price', 10, 2);
            $table->decimal('friday_price', 10, 2);
            $table->decimal('midweek', 10, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('periority')->nullable();
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
        Schema::dropIfExists('pricing_mechanisms');
    }
};
