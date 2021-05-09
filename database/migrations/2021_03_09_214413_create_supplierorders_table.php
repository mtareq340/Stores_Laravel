<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplierorders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_id');
           
            $table->double('total_price', 8, 2)->nullable();
            $table->double('paid_price', 8, 2)->nullable();
            $table->double('remaining_price', 8, 2)->nullable();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

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
        Schema::dropIfExists('supplierorders');
    }
}
