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
        Schema::table('units', function (Blueprint $table) {
            $table->decimal('insurance_amount', 10, 2)->after('mot_permission')->nullable(); // Adds a nullable decimal column for insurance amount
            $table->decimal('latitude', 10, 8)->nullable()->after('location'); // Adds a nullable decimal column for latitude
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude'); // Adds a nullable decimal column for longitude

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            
        });
    }
};
