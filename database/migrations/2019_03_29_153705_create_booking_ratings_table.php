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

            $table->unsignedTinyInteger('quality');
            $table->unsignedTinyInteger('facility');
            $table->unsignedTinyInteger('clear');
            $table->unsignedTinyInteger('comfortable');
            $table->unsignedTinyInteger('cp');
            $table->unsignedTinyInteger('position');
            $table->unsignedTinyInteger('free_wifi');

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
        Schema::dropIfExists('booking_ratings');
    }
}
