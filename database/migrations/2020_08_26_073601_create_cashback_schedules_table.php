<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashback_schedules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cashback_id');

            $table
                ->unsignedBigInteger('order_item_id')
                ->comment('Отдельный товар в заказе');

            $table
                ->unsignedDecimal('payout_amount')
                ->comment('Сумма выплаты');

            $table
                ->boolean('payout_complete')
                ->default(false)
                ->comment('Выплачено');

            $table
                ->timestamp('payout_at')
                ->comment('Дата выплаты');

            $table->timestamps();

            $table->index('payout_complete');

            $table->foreign('cashback_id')->references('id')->on('cashbacks');
            $table->foreign('order_item_id')->references('id')->on('order_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashback_schedules');
    }
}
