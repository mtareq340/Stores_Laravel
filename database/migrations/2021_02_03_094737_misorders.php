<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Misorders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misorders', function (Blueprint $table) {

        $table->increments('id');
        $table->unsignedInteger('order_id');
        $table->unsignedInteger('technical_id')->nullable();
        $table->unsignedInteger('store_id')->nullable();
        $table->double('total_price', 8, 2)->nullable();

        $table->foreign('technical_id')->references('id')->on('technicals')->onDelete('cascade');
        $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
        
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
        Schema::dropIfExists('misorders');
        
    }
}
