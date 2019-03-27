<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url_id');

            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('city_id')->nullable();

            $table->string('name');
            $table->string('translated_name');

            $table->string('address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            $table->string('checkin')->nullable();
            $table->string('checkout')->nullable();

            $table->text('introduction');

            $table->unsignedSmallInteger('total_room')->nullable();
            $table->unsignedSmallInteger('total_floor')->nullable();

            $table->string('year_of_open')->nullable();
            $table->string('year_of_renovated')->nullable();

            $table->timestamps();
            $table->softDeletes();
            // index
            $table->unique('url_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('hotels');
    }
}
