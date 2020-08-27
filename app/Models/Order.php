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
     *
     * @author Anton Reviakin
     */
    public const STATUS_ORDER_NEW = 0;
    public const STATUS_ORDER_PAYED = 1;
    public const STATUS_ORDER_CONFIRMED = 2;
    public const STATUS_ORDER_SENT = 3;
    public const STATUS_ORDER_RECEIVED = 4;
    public const STATUS_ORDER_CANCELED_BY_BUYER = 5;
    public const STATUS_ORDER_CANCELED_BY_SHOP = 6;
    public const STATUS_ORDER_REJECT = 7;


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
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cashback()
    {
        return $this->hasOne(Cashback::class);
    }

    public static function formatCost($cost = '')
    {
        return (int) str_replace(" ", "", $cost);
    }

}
