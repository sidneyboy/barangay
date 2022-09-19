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
        Schema::table('Users', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('position_type_id')->nullable();
            $table->string('spouse')->nullable();
            $table->string('office_term')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Users', function (Blueprint $table) {
            $table->dropColumn('gender')->nullable();
            $table->dropColumn('civil_status')->nullable();
            $table->dropColumn('birth_date')->nullable();
            $table->dropColumn('position_type_id')->nullable();
            $table->dropColumn('spouse')->nullable();
            $table->dropColumn('office_term')->nullable();
        });
    }
};
