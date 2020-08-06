<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('min_percent');
            $table->integer('max_percent');
            $table->integer('quantity_pay_every_month');
            $table->integer('quantity_pay_each_quarter');
            $table->integer('quantity_pay_every_six_months');
            $table->integer('quantity_pay_single');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_schedules');
    }
}
