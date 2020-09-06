<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
     * Изменить статус заказа
     *
     * @param Order       $order
     * @param int         $status
     * @param string|null $notes
     *
     * @return Order
     */
    public function changeOrderStatus(Order $order, int $status, string $notes = null): Order
    {
        $order->status = $status;
        $order->notes = $notes ?? $order->notes;

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
     * @param int            $userId
     * @param array|string[] $sort
     *
     * @return LengthAwarePaginator
     */
    public function ordersByUser(int $userId, array $sort = ['id', 'asc']): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->where('user_id', $userId)
            ->orderBy($sort)
            ->paginate(10);
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
     * Получить заказ покупателя по id заказа
     *
     * @param int $id
     *
     * @return Order|null
     *
     * @author Anton Reviakin
     */
    public function getOwnOrderBuyerById(int $id): ?Order
    {
        return Order::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
    }

    /**
     * Получить заказ продавца-владельца по id заказа
     *
     * @param int $id
     *
     * @return Order|null
     *
     * @author Anton Reviakin
     */
    public function getOwnOrderShopById(int $id): ?Order
    {
        return Order::where('id', $id)
            ->whereHas('items', function (Builder $query) {
                $query->whereHas('product', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->first();
    }

    /**
     * Список заказов продавца по статусам
     *
     * @param array $statuses
     *
     * @return LengthAwarePaginator
     *
     * @author Anton Reviakin
     */
    public function listOrdersShopByStatus(array $statuses): LengthAwarePaginator
    {
        return Order::whereIn('status', $statuses)
            ->whereHas('items', function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getOrderItemsOnlyThisShop(int $order_id)
    {
        return OrderItem::where('order_id', $order_id)
            ->whereHas('product', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
    }
}
