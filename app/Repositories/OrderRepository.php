<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
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
     * @param int $id
     *
     * @return Order
     */
    public function findOrderById(int $id): Order
    {
        return $this->findOneOrFail($id);
    }

    public function findOrderByNumber($orderNumber)
    {
        return Order::where('order_number', $orderNumber)->first();
    }

    public function listOrdersUser()
    {
        return Order::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function listOrdersShop()
    {
        return Order::where('status', Order::STATUS_ORDER_NEW)
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
