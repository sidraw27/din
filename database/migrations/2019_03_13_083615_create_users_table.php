<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provider_user_id');

            $table->string('origin_name');
            $table->string('display_name');

            $table->string('avatar')->nullable();
            $table->string('email')->nullable();

            $table->string('provider');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // index
            $table->unique([
                'provider_user_id',
                'provider'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
