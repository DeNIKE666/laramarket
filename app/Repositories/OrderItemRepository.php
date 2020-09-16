<?php


namespace App\Repositories;


use App\Models\OrderItem;
use Illuminate\Support\Collection;

class OrderItemRepository
{
    /** @var OrderItem */
    private $model;

    public function __construct(OrderItem $model)
    {
        $this->model = $model;
    }

    /**
     * Массово вставить продукты заказа
     *
     * @param array $orderItems
     *
     * @return bool
     */
    public function batchStore(array $orderItems): bool
    {
        return $this->model
            ->query()
            ->insert($orderItems);
    }

    /**
     * Получить товары по номеру заказа
     *
     * @param int $orderId
     *
     * @return Collection
     */
    public function getProductsByOrder(int $orderId): Collection
    {
        return $this
            ->model
            ->query()
            ->with('product')
            ->where('order_id', $orderId)
            ->get();
    }

}