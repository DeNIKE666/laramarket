<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table
                ->unsignedBigInteger('pay_system')
                ->comment('Платежная система');

            $table
                ->unsignedTinyInteger('trans_direction')
                ->comment('Направление транзакции: 0 - приход; 1 - расход');

            $table
                ->enum('trans_type', [
                    'purchase', //Оплата товара
                    'deposit',  //Ввод
                    'withdraw', //Вывод
                ])
                ->comment('Тип операции');

            $table->unsignedDecimal('amount');

            $table
                ->enum('status', [
                    'pending', //Новый, ожидает
                    'error',   //Ошибка
                    'complete' //Выполнено
                ])
                ->default('pending')
                ->comment('Статус');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pay_system')->references('id')->on('payment_options');

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
        Schema::dropIfExists('payments');
    }
}
