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
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('resident_id');
            $table->BigInteger('user_id')->nullable();
            $table->BigInteger('document_type_id');
            $table->string('status')->nullable();
            $table->string('time_approved')->nullable();
            $table->string('time_disapproved')->nullable();
            $table->string('time_received')->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('document_requests');
    }
};
