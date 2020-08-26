<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditPaymentOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_options', function (Blueprint $table) {
            $table->dropColumn('percent');
            $table->decimal('depositeMoney', 3 , 2)->default(0.00);
            $table->decimal('withdrawMoney', 3 , 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_options', function (Blueprint $table) {
            $table->integer('percent')->default(20);
            $table->dropColumn('depositeMoney');
            $table->dropColumn('withdrawMoney');
        });
    }
}
