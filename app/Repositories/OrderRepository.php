<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderRepository
{
    /** @var Order */
    private $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * Добавить заказ
     *
     * @param array $order
     *
     * @return Order
     */
    public function store(array $order): Order
    {
        return Order::create($order);
    }

    /**
     * Получить заказ по id заказа
     *
     * @param int $id
     *
     * @return Builder
     *
     * @author Anton Reviakin
     */
    public function getById(int $id): Builder
    {
        return $this
            ->model
            ->query()
            ->where('id', $id);
    }

    /**
     * Изменить статус заказа
     *
     * @param int $id
     * @param int $status
     *
     * @return Order
     */
    public function changeStatus(int $id, int $status): Order
    {
        /** @var Order $order */
        $order = $this
            ->getById($id)
            ->firstOrFail();

        $order->status = $status;

        $order->save();

        return $order;
    }

    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * Заказы пользователя
     *
     * @param int $userId
     *
     * @return Builder
     */
    public function ordersByUser(int $userId): Builder
    {
        return $this->model
            ->query()
            ->where('user_id', $userId);
    }

    public function listOrdersShop()
    {
        return Order::where('status', Order::ORDER_STATUS_NEW)
            ->whereHas('items', function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    /**
     * Список заказов продавца по статусам
     *
     * @param array $statuses
     * @param int   $sellerId
     * @param array $sort
     *
     * @return Builder
     *
     * @author Anton Reviakin
     */
    public function listOrdersSellerByStatus(array $statuses, int $sellerId, array $sort = ['id', 'desc']): Builder
    {
        return $this
            ->model
            ->query()
            ->whereIn('status', $statuses)
            ->ofSeller($sellerId)
            ->with('orderHold')
            ->orderBy($sort[0], $sort[1]);
    }

    /**
     * Детали заказа
     *
     * @param int $id
     * @param int $sellerId
     *
     * @return Builder
     */
    public function getOrderDetailsForSeller(int $id, int $sellerId): Builder
    {
        return $this
            ->model
            ->query()
            ->where('id', $id)
            ->ofSeller($sellerId)
            ->with('currentStatus')     //Текущий статус заказа
            ->with('itemsWithProducts') //Продукты в заказе
            ->with('deliveryProfile')   //Профиль доставки
            ->with('payment');          //Оплата
    }
}
