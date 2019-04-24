<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedTinyInteger('quality')->nullable();
            $table->unsignedTinyInteger('facility')->nullable();
            $table->unsignedTinyInteger('clear')->nullable();
            $table->unsignedTinyInteger('comfortable')->nullable();
            $table->unsignedTinyInteger('cp')->nullable();
            $table->unsignedTinyInteger('position')->nullable();
            $table->unsignedTinyInteger('free_wifi')->nullable();

            $table->timestamps();
            // index
            $table->foreign('id')->references('booking_id')->on('hotel_ratings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_ratings');
    }
}
