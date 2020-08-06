<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPay extends Model
{
    protected $fillable = [
        'user_id',
        'pay_system',
        'amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
