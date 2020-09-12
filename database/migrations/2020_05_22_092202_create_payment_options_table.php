<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

            $table->string('slug');

            $table
                ->string('icon')
                ->nullable();

            //Оплата заказа
            $table
                ->boolean('is_purchasing')
                ->default(false);
            $table
                ->decimal('purchasing_fee', 3, 2)
                ->default(0);

            //Пополнение счета
            $table
                ->boolean('is_refill')
                ->default(false);
            $table
                ->decimal('depositeMoney', 3, 2)
                ->default(0);

            //Вывод средств
            $table
                ->boolean('is_withdrawal')
                ->default(false);
            $table
                ->decimal('withdrawMoney', 3, 2)
                ->default(0);

            $table
                ->integer('sort')
                ->default(10);
        });

        $payments = [
            [
                'title'         => 'Банковские карты',
                'slug'          => 'card',
                'icon'          => 'img/pay/mastercard1.png',
                'is_purchasing' => true,
                'is_refill'     => true,
                'is_withdrawal' => true,
                'sort'          => 1,
            ],
            [
                'title'         => 'Яндекс деньги',
                'slug'          => 'yandex',
                'icon'          => 'img/pay/yandex1.png',
                'is_purchasing' => true,
                'is_refill'     => true,
                'is_withdrawal' => true,
                'sort'          => 2,
            ],
            [
                'title'         => 'Qiwi',
                'slug'          => 'qiwi',
                'icon'          => 'img/pay/qiwi1.png',
                'is_purchasing' => true,
                'is_refill'     => true,
                'is_withdrawal' => true,
                'sort'          => 3,
            ],
            [
                'title'         => 'Криптовалюта',
                'slug'          => 'crypto',
                'icon'          => 'img/pay/crypto.png',
                'is_purchasing' => true,
                'is_refill'     => true,
                'is_withdrawal' => true,
                'sort'          => 4,
            ],
            [
                'title'         => 'Безналичный расчет',
                'slug'          => 'cashless',
                'icon'          => '',
                'is_purchasing' => true,
                'is_refill'     => true,
                'is_withdrawal' => true,
                'sort'          => 5,
            ],
        ];

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
