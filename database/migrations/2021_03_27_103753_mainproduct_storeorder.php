<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MainproductStoreorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mainproduct_storeorder', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('mainproduct_id')->nullable();
            $table->unsignedInteger('storeorder_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->double('unitprice');

            $table->foreign('mainproduct_id')->references('id')->on('mainproducts')->onDelete('cascade');
            $table->foreign('storeorder_id')->references('id')->on('storeorders')->onDelete('cascade');
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
