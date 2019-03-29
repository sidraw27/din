<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgodaRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agoda_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedTinyInteger('overall');
            $table->unsignedTinyInteger('facility');
            $table->unsignedTinyInteger('position');
            $table->unsignedTinyInteger('service');
            $table->unsignedTinyInteger('cp');

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
        Schema::dropIfExists('agoda_ratings');
    }
}
