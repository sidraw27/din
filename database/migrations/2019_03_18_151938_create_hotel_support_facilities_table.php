<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelSupportFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_support_facilities', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('facility_id');
            $table->boolean('is_active');
            // index
            $table->index([
                'hotel_id',
                'is_active'
            ]);
            $table->primary(['hotel_id', 'facility_id']);
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('facility_id')->references('id')->on('hotel_facilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_support_facilities');
    }
}
