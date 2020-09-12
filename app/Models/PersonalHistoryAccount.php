<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalHistoryAccount extends Model
{
    protected $fillable = [
        'user_id',
        'trans_direction',
        'trans_type',
        'pay_system_id',
        'amount',
    ];

    //Направления транзакции
    const DIR_IN = 0;
    const DIR_OUT = 1;

    //Тип транзакции
    const TYPE_DEPOSIT = 'deposit';                             //Пополнение
    const TYPE_WITHDRAW = 'withdraw';                           //Вывод
    const TYPE_PURCHASE = 'purchase';                           //Покупка товара
    const TYPE_DEPOSIT_FROM_CASHBACK = 'deposit_from_cashback'; //Перевод со счета Кэшбэк
    const TYPE_DEPOSIT_FROM_SELLER = 'deposit_from_seller';     //Перевод со счета Продавец
    const TYPE_DEPOSIT_FROM_PARTNER = 'deposit_from_partner';   //Перевод со счета Партнер

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paySystem()
    {
        return $this->belongsTo(PaymentOption::class);
    }
}
