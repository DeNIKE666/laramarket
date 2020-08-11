<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePaymentOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_options', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('percent')->default(20);
            $table->string('ico')->nullable();
            $table->boolean('is_refill')->nullable();
            $table->boolean('is_withdrawal')->nullable();
            $table->integer('sort')->default(10);
        });

        $payments = array(
            array('title' => 'Банковские карты','percent' => 20,'ico' => 'img/pay/mastercard1.png','is_refill' => 1,'is_withdrawal' => 1, 'sort' => 1),
            array('title' => 'Яндекс деньги','percent' => 20,'ico' => 'img/pay/yandex1.png','is_refill' => 1,'is_withdrawal' => 1, 'sort' => 2),
            array('title' => 'Qiwi','percent' => 20,'ico' => 'img/pay/qiwi1.png','is_refill' => 1,'is_withdrawal' => 1, 'sort' => 3),
            array('title' => 'Криптовалюта','percent' => 20,'ico' => 'img/pay/crypto.png','is_refill' => 1,'is_withdrawal' => 1, 'sort' => 4),
            array('title' => 'Безналичный расчет','percent' => 20,'ico' => '','is_refill' => 1,'is_withdrawal' => 1, 'sort' => 5),
        );

        DB::table('payment_options')->insert($payments);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_options');
    }
}
