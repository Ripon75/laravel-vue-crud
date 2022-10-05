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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('delivery_type_id')->nullable();
            $table->foreignId('payment_method_id')->nullable();
            $table->foreignId('shipping_address_id')->nullable();
            $table->foreignId('coupon_id')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->foreignId('current_status_id')->nullable();
            $table->timestamp('current_status_at')->nullable();
            $table->decimal('refund_amount', 20, 2)->nullable();
            $table->string('refund_status')->nullable();
            $table->timestamp('refund_date')->nullable();
            $table->string('note', 1024)->nullable();
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
