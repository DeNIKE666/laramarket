<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldsSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holds_schedules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');

            $table->boolean('is_complete')
                ->default(false)
                ->comment('Выполнено ли');

            $table
                ->timestamp('expired_at')
                ->comment('Дата окончания холда');

            $table
                ->boolean('is_expired')
                ->default(false)
                ->comment('Выполнено по экспирации');

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
        Schema::dropIfExists('holds_schedules');
    }
}
