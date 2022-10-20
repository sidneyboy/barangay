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
        Schema::table('Residents', function (Blueprint $table) {
        $table->string('present_house_block')->nullable();
        $table->string('present_subd')->nullable();
        $table->string('present_municipality')->nullable();
        $table->string('present_province')->nullable();
        $table->string('present_living_status')->nullable();
        $table->string('present_length_of_stay')->nullable();
        $table->string('provincial_house_block')->nullable();
        $table->string('provincial_subd')->nullable();
        $table->string('provincial_municipality')->nullable();
        $table->string('provincial_province')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Residents', function (Blueprint $table) {
            //
        });
    }
};
