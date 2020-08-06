<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{

    protected $fillable = [
        'min_percent',
        'max_percent',
        'quantity_pay_every_month',
        'quantity_pay_each_quarter',
        'quantity_pay_every_six_months',
        'quantity_pay_single',
    ];

    public $timestamps = false;

}
