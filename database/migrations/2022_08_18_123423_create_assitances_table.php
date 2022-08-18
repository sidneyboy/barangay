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
        Schema::create('assitances', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('assistance_type_id');
            $table->BigInteger('resident_id');
            $table->longText('explanation');
            $table->bigInteger('barangay_id');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('assitances');
    }
};
