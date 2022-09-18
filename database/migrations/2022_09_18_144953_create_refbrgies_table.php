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
        Schema::create('refbrgies', function (Blueprint $table) {
            $table->id();
            $table->string('brgyCode');
            $table->longText('brgyDesc');
            $table->string('regCode');
            $table->longText('provCode');
            $table->string('citymunCode');
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
        Schema::dropIfExists('refbrgies');
    }
};
