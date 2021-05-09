<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_country', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->double('price')->default(0);
            

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_country');
        
    }
}
