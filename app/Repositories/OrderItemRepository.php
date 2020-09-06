<?php


namespace App\Repositories;


use App\Models\OrderItem;

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

}