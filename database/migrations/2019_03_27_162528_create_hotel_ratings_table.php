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
            $table->bigIncrements('id');

            $table->unsignedBigInteger('hotel_id');

            $table->unsignedTinyInteger('overall');
            $table->unsignedTinyInteger('facility');
            $table->unsignedTinyInteger('position');
            $table->unsignedTinyInteger('service');
            $table->unsignedTinyInteger('cp');

            $table->timestamps();
            // index
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
