<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MainproductSupplierorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mainproduct_supplierorder', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('mainproduct_id')->nullable();
            $table->unsignedInteger('supplierorder_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->double('unitprice');

            $table->foreign('mainproduct_id')->references('id')->on('mainproducts')->onDelete('cascade');
            $table->foreign('supplierorder_id')->references('id')->on('supplierorders')->onDelete('cascade');
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
