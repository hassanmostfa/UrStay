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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id');
            $table->string('discount_name');
            $table->string('discount_type');
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('no_of_nights')->nullable();
            $table->string('no_of_units');
            $table->tinyInteger('unit_id')->nullable();
            $table->string('percentage');
            $table->string('applied_on');
            $table->string('code');
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
        Schema::dropIfExists('coupons');
    }
};
