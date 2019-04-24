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

            $table->unsignedTinyInteger('overall')->nullable();
            $table->unsignedTinyInteger('facility')->nullable();
            $table->unsignedTinyInteger('position')->nullable();
            $table->unsignedTinyInteger('comfortable')->nullable();
            $table->unsignedTinyInteger('service')->nullable();
            $table->unsignedTinyInteger('cp')->nullable();

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
