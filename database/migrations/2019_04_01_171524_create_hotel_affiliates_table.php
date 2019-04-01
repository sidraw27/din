<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_affiliates', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id')->primary();

            $table->unsignedBigInteger('agoda_hotel_id')->nullable()->unique();
            $table->unsignedBigInteger('booking_hotel_id')->nullable()->unique();
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
        Schema::dropIfExists('hotel_affiliates');
    }
}
