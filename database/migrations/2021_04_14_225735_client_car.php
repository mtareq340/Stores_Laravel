<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientCar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_car', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('car_id');
            $table->string('carnumber')->nullable();
            $table->unsignedInteger('carcolor_id')->nullable();
    
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('carcolor_id')->references('id')->on('carcolors')->onDelete('cascade');

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
