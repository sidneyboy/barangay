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
        Schema::table('assitances', function (Blueprint $table) {
            $table->double('approved_cash')->nullable();
            $table->string('approved_by_official_id');
            $table->string('approved_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assitances', function (Blueprint $table) {
            //
        });
    }
};
