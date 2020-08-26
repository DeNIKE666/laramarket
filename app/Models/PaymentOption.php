<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentOption extends Model
{
    protected $fillable = [
        'title',
        'ico',
        'is_refill',
        'is_withdrawal',
        'sort',
        'depositeMoney',
        'withdrawMoney'
    ];

    public $timestamps = false;

    public function scopeRefill($query) {
        return $this->where('is_refill', 1)->orderBy("sort", "asc");
    }

    public static function getPaymentsRefill()
    {
        return PaymentOption::Refill()->get();
    }
}
