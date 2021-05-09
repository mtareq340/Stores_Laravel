<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreMainproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_mainproducts', function (Blueprint $table) {

        $table->increments('id');
        $table->integer('mainproduct_id')->nullable();
        $table->unsignedInteger('store_id')->nullable();
        $table->integer('quantity')->default(0);

        $table->foreign('mainproduct_id')->references('id')->on('mainproducts')->onDelete('cascade');
        $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
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
