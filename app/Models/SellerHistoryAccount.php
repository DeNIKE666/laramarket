<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerHistoryAccount extends Model
{
    protected $fillable = [
        'user_id',
        'with_user_id',
        'trans_direction',
        'trans_type',
        'amount',
        'percent',
    ];

    //Направления транзакции
    const DIR_IN = 0;
    const DIR_OUT = 1;

    //Тип транзакции
    const TYPE_PURCHASE = 'purchase';
    const TYPE_PLATFORM_FEE = 'platform_fee';
    const TYPE_PAYOUT_LINE_1 = 'payout_line_1';
    const TYPE_PAYOUT_LINE_2 = 'payout_line_2';
    const TYPE_PAYOUT_LINE_3 = 'payout_line_3';
    const TYPE_WITHDRAW_TO_PERSONAL = 'withdraw_to_personal';
}
