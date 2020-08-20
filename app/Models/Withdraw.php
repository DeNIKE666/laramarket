<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'amount',
        'pay_system',
        'user_id',
        'status'
    ];
}
