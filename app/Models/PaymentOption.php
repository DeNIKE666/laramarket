<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentOption extends Model
{
    protected $fillable = [
        'title',
        'percent',
        'ico',
        'is_refill',
        'is_withdrawal',
        'sort'
    ];

    public $timestamps = false;

    public static function getPaymentsRefill()
    {
        return PaymentOption::where('is_refill', 1)->orderBy("sort", "asc")->get();
    }
}
