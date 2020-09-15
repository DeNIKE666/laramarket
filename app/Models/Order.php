<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    /**
     * Список статусов
     *
     * @author Anton Reviakin
     */
    const ORDER_STATUS_NEW = 0;
    const ORDER_STATUS_PAYED = 1;
    const ORDER_STATUS_CONFIRMED = 2;
    const ORDER_STATUS_SENT = 3;
    const ORDER_STATUS_RECEIVED = 4;
    const ORDER_STATUS_CANCELED_BY_BUYER = 5;
    const ORDER_STATUS_CANCELED_BY_SHOP = 6;
    const ORDER_STATUS_REJECT = 7;

    /**
     * Службы доставки
     *
     * @author Anton Reviakin
     */
    const DELIVERY_WITH_CDEK = 'cdek';
    const DELIVERY_WITH_ENERGY = 'energy';
    const DELIVERY_WITH_COURIER = 'courier';

    protected $fillable = [
        'user_id',
        'delivery_profile_id',
        'cost',
        'pay_system',
        'delivery_service',
        'status',
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

    public function paySystem()
    {
        return $this->belongsTo(PaymentOption::class, 'pay_system');
    }

    public function deliveryProfile()
    {
        return $this->hasOne(OrdersDeliveryProfile::class);
    }

    public function cashback()
    {
        return $this->hasOne(Cashback::class);
    }

    public static function formatCost($cost = '')
    {
        return (int)str_replace(" ", "", $cost);
    }

    /**
     * Список служб доставки
     *
     * @return string[]
     * @author Anton Reviakin
     */
    public function getDeliveryServices(): array
    {
        return [
            self::DELIVERY_WITH_CDEK,
            self::DELIVERY_WITH_ENERGY,
            self::DELIVERY_WITH_COURIER,
        ];
    }

    /**
     * Заказ покупателя
     *
     * @param Builder  $builder
     * @param int|null $userId
     *
     * @return Builder
     * @author Reviakin Anton
     */
    public function scopeOfBuyer(Builder $builder, int $userId = null): Builder
    {
        if (!$userId) {
            return $builder;
        }

        return $builder->where('user_id', $userId);
    }

    /**
     * Заказ продавца
     *
     * @param Builder  $builder
     * @param int|null $userId
     *
     * @return Builder
     */
    public function scopeOfSeller(Builder $builder, int $userId = null): Builder
    {
        if (!$userId) {
            return $builder;
        }

        return $builder
            ->whereHas('items', function (Builder $query) use ($userId) {
                $query->whereHas(
                    'product',
                    function (Builder $query) use ($userId) {
                        $query->where('user_id', $userId);
                    }
                );
            });
    }
}
