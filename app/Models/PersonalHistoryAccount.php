<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalHistoryAccount extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paySystem()
    {
        return $this->belongsTo(PaymentOption::class);
    }
}
