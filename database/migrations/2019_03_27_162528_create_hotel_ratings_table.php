<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id')->unique();
            $table->unsignedBigInteger('agoda_id')->nullable();
            $table->unsignedBigInteger('booking_id')->nullable();
            // index
            $table->primary('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_ratings');
    }
}
