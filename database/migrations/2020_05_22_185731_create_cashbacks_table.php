<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');

            $table
                ->unsignedDecimal('cost')
                ->default(0);

            $table->unsignedTinyInteger('status')
                ->default(0)
                ->comment('0 - ожидает получения товара покупателем; 1 - отмена заказа; 2 - идут выплаты; 3 - выплаты завершены');

            $table->unsignedTinyInteger('period')
                ->nullable()
                ->comment('0 - каждый мес.; 1 - каждый квартал; 2 - каждые 6 мес.; 3 - единоразовая выплата');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashbacks');
    }
}
