<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
            $table->string('value');
        });

        Schema::table('products', function(Blueprint $table){
            $table->integer('part_cashback')->default(30);
        });

        Schema::table('cashbacks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('cost')->default(0);
            $table->date('payment_date');
            $table->string('status')->default('wait');
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');

        Schema::table('orders', function(Blueprint $table) {
            $table->dropColumn('part_cashback');
        });

        Schema::table('cashbacks', function(Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('order_id');
            $table->dropColumn('cost');
            $table->dropColumn('payment_date');
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });
    }
}
