<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'amount',
        'payment_options_id',
        'user_id',
        'status'
    ];

    public function paymentOption()
    {
        return $this->hasOne(PaymentOption::class, 'id');
    }
}
