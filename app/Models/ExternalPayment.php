<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalPayment extends Model
{
    protected $fillable = [
        'user_id',
        'pay_system',
        'trans_direction',
        'trans_type',
        'amount',
        'status',
    ];

    //Направления транзакции
    const DIR_IN = 0;
    const DIR_OUT = 1;

    //Тип транзакции
    const TYPE_PURCHASE = 'purchase';
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAW = 'withdraw';

    //Статус транзакции
    const STATUS_PENDING = 'pending';
    const STATUS_ERROR = 'error';
    const STATUS_COMPLETE = 'complete';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paySystem()
    {
        return $this->belongsTo(PaymentOption::class, 'pay_system');
    }
}
