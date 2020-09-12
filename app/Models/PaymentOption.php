<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PaymentOption extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'is_purchasing',
        'purchasing_fee',
        'is_refill',
        'depositeMoney',
        'is_withdrawal',
        'withdrawMoney',
        'sort',
    ];

    public $timestamps = false;

    public function scopePurchasing(Builder $builder): Builder
    {
        return $builder->where('is_purchasing', true);
    }

    public function scopeDepositing(Builder $builder): Builder
    {
        return $builder->where('is_refill', true);
    }

    public function scopeWithdrawal(Builder $builder): Builder
    {
        return $builder->where('is_withdrawal', true);
    }
}
