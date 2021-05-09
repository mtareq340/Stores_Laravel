<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('technical_id')->nullable();
            $table->unsignedInteger('store_id')->nullable();
            $table->double('total_price', 8, 2)->nullable();
            $table->unsignedInteger('client_car_id')->nullable();
            $table->boolean('confirmed')->default(0);
            $table->boolean('price_confirmed')->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->double('price_after_discount', 8, 2)->default(0);
            $table->boolean('discount_confirmed')->default(0);


            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('technical_id')->references('id')->on('technicals')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_car_id')->references('id')->on('client_car')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
