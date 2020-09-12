<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('delivery_profile_id');

            $table->unsignedDecimal('cost');

            $table->unsignedBigInteger('pay_system');

            $table
                ->enum('delivery_service', [
                    'cdek',
                    'energy',
                    'courier',
                ])
            ->comment('Служба доставки');

            $table
                ->unsignedTinyInteger('status')
                ->default(0);

            $table
                ->string('notes')
                ->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pay_system')->references('id')->on('payment_options');
            $table->foreign('delivery_profile_id')->references('id')->on('orders_delivery_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
