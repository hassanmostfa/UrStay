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
        Schema::table('users', function (Blueprint $table) {
            $table->string('personal_id')->nullable()->after('role');
            $table->date('birth_date')->nullable()->after('personal_id');
            $table->string('passport_number')->nullable()->after('birth_date');
            $table->string('nationality')->nullable()->after('passport_number');
            $table->string('residence_number')->nullable()->after('nationality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
