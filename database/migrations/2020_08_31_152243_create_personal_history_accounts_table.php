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
            $table
                ->unsignedBigInteger('receiver_id')
                ->comment('Получатель');

            $table
                ->unsignedBigInteger('sender_id')
                ->nullable()
                ->comment('Отправитель');

            $table
                ->unsignedTinyInteger('trans_direction')
                ->comment('Направление транзакции: 0 - приход; 1 - расход');

            $table
                ->enum('trans_type', [
                    'deposit',               //Пополнение
                    'withdraw',              //Вывод
                    'transfer',              //Перевод между аккаунтами
                    'purchase',              //Покупка товара
                    'deposit_from_cashback', //Перевод со счета Кешбэк
                    'deposit_from_seller',   //Перевод со счета Продавец
                    'deposit_from_partner',  //Перевод со счета Партнер
                ])
                ->comment('Тип операции');

            $table->unsignedDecimal('amount');

            $table->timestamps();

            $table->foreign('receiver_id')->references('id')->on('users');
            $table->foreign('sender_id')->references('id')->on('users');

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
