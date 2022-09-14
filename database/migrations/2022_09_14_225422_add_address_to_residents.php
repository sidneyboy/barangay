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
            $table->longText('current_address')->nullable();
            $table->longText('permanent_address')->nullable();
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
            $table->dropColumn('current_address')->nullable();
            $table->dropColumn('permanent_address')->nullable();
        });
    }
};
