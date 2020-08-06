<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    protected $table = 'orders';

    /**
     * Список статусов
     */
    public const STATUS_ORDER_START = 'pending';


    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phones',
        'payment_method',
        'delivery',
        'cost',
        'status',
        'payment_status',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function formatCost($cost = '')
    {
        return (int) str_replace(" ", "", $cost);
    }

}
