<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('type_shop')->nullable();
            $table->string('inn')->nullable();
            $table->string('ogrnip')->nullable();
            $table->string('ur_address')->nullable();
            $table->string('form_of_taxation')->nullable();
            $table->string('bank')->nullable();
            $table->string('bik')->nullable();
            $table->string('rs')->nullable();
            $table->string('ks')->nullable();
            $table->string('fio_director')->nullable();
            $table->string('kpp')->nullable();
            $table->string('ogrn')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_issued')->nullable();
            $table->string('name_company')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
