<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalHistoryAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_history_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table
                ->unsignedTinyInteger('trans_direction')
                ->comment('Направление транзакции: 0 - приход; 1 - расход');

            $table
                ->enum('trans_type', [
                    'deposit',               //Пополнение
                    'withdraw',              //Вывод
                    'purchase',              //Покупка товара
                    'deposit_from_cashback', //Перевод со счета Кэшбэк
                    'deposit_from_seller',   //Перевод со счета Продавец
                    'deposit_from_partner',  //Перевод со счета Партнер
                ])
                ->comment('Тип операции');

            $table
                ->unsignedBigInteger('pay_system_id')
                ->nullable()
                ->comment('Платежная система');

            $table->unsignedDecimal('amount');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pay_system_id')->references('id')->on('payment_options');

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
        Schema::dropIfExists('personal_history_accounts');
    }
}
