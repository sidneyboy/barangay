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
        Schema::create('resident_households', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('resident_id');
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('age')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('occupation')->nullable();
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
        Schema::dropIfExists('resident_households');
    }
};
