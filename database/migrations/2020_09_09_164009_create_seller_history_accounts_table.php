<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerHistoryAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_history_accounts', function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger('user_id')
                ->comment('Продавец');

            $table
                ->unsignedBigInteger('with_user_id')
                ->nullable()
                ->comment('Задействованный пользователь');

            $table
                ->unsignedTinyInteger('trans_direction')
                ->comment('Направление транзакции: 0 - приход; 1 - расход');

            $table
                ->enum('trans_type', [
                    'purchase',             //Выплата за товар
                    'platform_fee',         //Комиссия площадки
                    'payout_line_1',        //Партнерская выплата 1-й линии
                    'payout_line_2',        //Партнерская выплата 2-й линии
                    'payout_line_3',        //Партнерская выплата 3-й линии
                    'withdraw_to_personal', //Вывод на персональный счет
                ])
                ->comment('Тип операции');

            $table->unsignedDecimal('amount');

            $table
                ->unsignedTinyInteger('percent')
                ->nullable()
                ->comment('Процент');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('with_user_id')->references('id')->on('users');

            $table->index('trans_direction');
            $table->index('trans_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_history_accounts');
    }
}
