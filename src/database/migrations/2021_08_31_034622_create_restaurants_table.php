<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cnpj', 18);
            $table->string('address');
            $table->string('zip_code');
            $table->string('phone');
            $table->string('location');
            $table->string('state');
            $table->boolean('status');
            $table->bigInteger('responsible_id')->unsigned()->nullable();
            $table->foreign('responsible_id')->references('id')->on('users')->restrict();
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
        Schema::dropIfExists('restaurants');
    }
}
