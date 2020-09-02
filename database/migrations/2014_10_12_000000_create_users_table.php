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
                    'buyer',
                    'buyer_partner',
                    'seller',
                    'seller_partner',
                    'moderator',
                    'admin',
                ])
                ->default('buyer')
                ->comment('Роль');

            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table
                ->boolean('request_seller')
                ->default(false)
                ->comment('Запрос на роль Продавец');

            $table
                ->unsignedDecimal('personal_account')
                ->default(0)
                ->comment('Счет персональный (основной)');
            $table
                ->unsignedDecimal('cashback_account')
                ->default(0)
                ->comment('Счет для кешбэка');
            $table
                ->unsignedDecimal('seller_account')
                ->default(0)
                ->comment('Счет продавца');
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
