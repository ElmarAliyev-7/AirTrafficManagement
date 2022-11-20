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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->dateTime('date');
            $table->string('country_image');
            $table->unsignedBigInteger('pilot_id');
            $table->unsignedBigInteger('plane_id');
            $table->timestamps();

            $table->foreign('pilot_id')->references('id')->on('pilots');
            $table->foreign('plane_id')->references('id')->on('planes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
