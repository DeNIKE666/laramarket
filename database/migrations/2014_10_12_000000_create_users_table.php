<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');

            $table->unsignedBigInteger('partner_id')
                ->nullable()
                ->comment('Партнер-пригласитель');

            $table
                ->string('partner_token')
                ->unique()
                ->nullable()
                ->comment('Код приглашения для партнера');

            $table
                ->enum('role', [
                    'user',
                    'user_partner',
                    'shop',
                    'shop_partner',
                    'moderator',
                    'admin',
                ])
                ->default('user')
                ->comment('Роль');

            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table
                ->boolean('request_shop')
                ->default(false)
                ->comment('Запрос на роль Магазин');

            $table
                ->unsignedDecimal('personal_account')
                ->default(0)
                ->comment('Счет персональный (основной)');
            $table
                ->unsignedDecimal('cashback_account')
                ->default(0)
                ->comment('Счет для кешбэка');
            $table
                ->unsignedDecimal('shop_account')
                ->default(0)
                ->comment('Счет магазина');
            $table
                ->unsignedDecimal('partner_account')
                ->default(0)
                ->comment('Счет партнера');

            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();

            $table->timestamps();

            $table->index('partner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
