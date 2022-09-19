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
        Schema::table('Barangays', function (Blueprint $table) {
            $table->string('provCode')->nullable();
            $table->string('citymunCode')->nullable();
            $table->string('regCode')->nullable();
            $table->string('brgyCode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Barangays', function (Blueprint $table) {
            $table->dropColumn('provCode')->nullable();
            $table->dropColumn('citymunCode')->nullable();
            $table->dropColumn('regCode')->nullable();
            $table->dropColumn('brgyCode')->nullable();
        });
    }
};
