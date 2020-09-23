<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersHoldsSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_holds_schedules', function (Blueprint $table) {
            $table->id();

            $table
                ->unsignedBigInteger('order_id')
                ->unique();

            $table->boolean('is_complete')
                ->default(false)
                ->comment('Выполнено ли');

            $table
                ->timestamp('completed_at')
                ->nullable()
                ->comment('Дата выполнения');

            $table
                ->boolean('is_expired')
                ->default(false)
                ->comment('Выполнено по экспирации');

            $table
                ->timestamp('expired_at')
                ->nullable()
                ->comment('Дата окончания холда');

            $table->timestamps();

            $table->index('is_complete');

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
        Schema::dropIfExists('orders_holds_schedules');
    }
}
