<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashback extends Model
{
    //Статусы выплат
    public const STATUS_WAIT_FOR_RECEIVE = 0;
    public const STATUS_ORDER_CANCELED = 1;
    public const STATUS_PAYOUTS_IN_PROGRESS = 2;
    public const STATUS_PAYOUTS_FINISHED = 3;

    //Периоды выплат
    public const PERIOD_EVERY_MONTH = 0;
    public const PERIOD_EVERY_3_MONTHS = 1;
    public const PERIOD_EVERY_6_MONTHS = 2;
    public const PERIOD_SINGLE = 3;

    protected $fillable = [
        'user_id',
        'order_id',
        'cost',
        'status',
        'period',
    ];

    public function schedules()
    {
        return $this->hasMany(CashbackSchedule::class);
    }

    public function nextCashbackPayout()
    {
        return $this
            ->hasOne(CashbackSchedule::class)
            ->where('payout_complete', false)
            ->orderBy('id');
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
