<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('mrp', 20, 2)->nullable();
            $table->decimal('price', 20, 2)->nullable()
            ->commit('Price of the item when it`s added into the cart');
            $table->decimal('discount', 20, 2)->nullable();
            $table->foreignId('promotion_id')->nullable();
            $table->string('status')->default('ok');
            $table->foreignId('ex_item_id')->nullable()->commit('Exchanged product id');
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
        Schema::dropIfExists('order_product');
    }
}
