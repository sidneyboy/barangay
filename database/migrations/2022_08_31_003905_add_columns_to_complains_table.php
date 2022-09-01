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
        Schema::table('Complains', function (Blueprint $table) {
            $table->string('time_started')->nullable();
            $table->string('time_ended')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Complains', function (Blueprint $table) {
            $table->dropColumn('time_started')->nullable();
            $table->dropColumn('time_ended')->nullable();
        });
    }
};