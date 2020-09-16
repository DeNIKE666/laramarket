<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrdersHoldsSchedule extends Model
{
    protected $fillable = [
        'order_id',
        'is_complete',
        'expired_at',
        'is_expired',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Завершенные
     *
     * @param Builder $builder
     * @param bool    $isComplete
     *
     * @return Builder
     */
    public function scopeComplete(Builder $builder, bool $isComplete = false): Builder
    {
        return $builder->where('is_complete', $isComplete);
    }
}
