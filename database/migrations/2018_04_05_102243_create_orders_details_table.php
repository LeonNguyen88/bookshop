<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orders_id')->unsigned()->index();
            $table->integer('products_id')->unsigned()->index();
            $table->integer('quantity');
            $table->integer('price');
            $table->string('status')->default('Chưa giao hàng');
            $table->timestamps();

            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_details');
    }
}
