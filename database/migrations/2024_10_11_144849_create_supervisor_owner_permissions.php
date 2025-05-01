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
        Schema::create('supervisor_owner_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained();
            $table->foreignId('supervisor_id')->constrained();
            $table->string('permission');
            $table->string('permission_ar');
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
        Schema::dropIfExists('supervisor_owner_permissions');
    }
};
