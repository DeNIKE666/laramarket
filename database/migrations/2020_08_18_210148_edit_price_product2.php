<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditPriceProduct2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function(Blueprint $table){
            $table->dropColumn('old_price');
            $table->dropColumn('price');
        });

        Schema::table('products', function(Blueprint $table){
            $table->decimal('old_price', 8, 2)->nullable();
            $table->decimal('price', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
