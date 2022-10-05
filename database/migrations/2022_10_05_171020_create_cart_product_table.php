<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->foreignId('cart_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('mrp', 20, 2)->default(0);
            $table->decimal('price', 20, 2)->default(0);
            $table->decimal('discount', 20, 2)->default(0);
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
        Schema::dropIfExists('cart_product');
    }
}
