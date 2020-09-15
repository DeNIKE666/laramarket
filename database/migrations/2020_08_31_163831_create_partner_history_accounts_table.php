<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerHistoryAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_history_accounts', function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger('receiver_id')
                ->comment('Получатель');

            $table
                ->unsignedBigInteger('sender_id')
                ->nullable()
                ->comment('Реферал (продавец)');

            $table->unsignedBigInteger('order_id');

            $table
                ->unsignedTinyInteger('percent')
                ->default(0)
                ->comment('Партнерский процент');

            $table->unsignedDecimal('amount');

            $table->timestamps();

            $table->foreign('receiver_id')->references('id')->on('users');
            $table->foreign('sender_id')->references('id')->on('users');
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
        Schema::dropIfExists('partner_history_accounts');
    }
}
