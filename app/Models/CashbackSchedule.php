<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashbackSchedule extends Model
{
    protected $fillable = [
        'cashback_id',
        'order_item_id',
        'payout_amount',
        'payout_at'
    ];

    public function cashback()
    {
        return $this->belongsTo(Cashback::class);
    }

    public function orderItems()
    {
        return $this->hasOne(OrderItem::class);
    }
}
