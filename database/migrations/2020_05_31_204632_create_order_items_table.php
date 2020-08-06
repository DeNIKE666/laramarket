<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedInteger('quantity');
            $table->integer('price');
            $table->date('delivery_date')->nullable();
            $table->string('status')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });

        Schema::table('orders', function(Blueprint $table){
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->boolean('payment_status')->default(0);
            $table->string('select_cashback')->nullable();
            $table->smallInteger('price_cashback')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');

        Schema::table('orders', function(Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('notes');
            $table->dropColumn('payment_status');
            $table->dropColumn('select_cashback');
            $table->dropColumn('price_cashback');
        });
    }
}
