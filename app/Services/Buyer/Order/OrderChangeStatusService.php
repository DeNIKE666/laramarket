<?php


namespace App\Services\Buyer\Order;


use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\Order\OrderHistoryStatusService;
use Illuminate\Http\Response;

class OrderChangeStatusService
{
    /** @var OrderRepository $orderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Изменить статус заказа
     *
     * @param int $orderId
     * @param int $userId
     * @param int $status
     *
     * @return Order
     */
    public function changeStatus(int $orderId, int $userId, int $status): Order
    {
        /** @var Order $order */
        $order = $this
            ->orderRepository
            ->getById($orderId)
            ->ofBuyer($userId)
            ->firstOrFail();

        if (!$this->statusAllowed($order, $status)) {
            abort(Response::HTTP_FORBIDDEN, 'Невозможно выбрать этот статус');
        }

        //Изменить статус заказа
        $order = $this
            ->orderRepository
            ->changeStatus(
                $order->id,
                $status
            );

        //Добавить статус в историю заказа
        (new OrderHistoryStatusService)
            ->storeOrderHistoryStatus(
                $order,
                $status
            );

        return $order;
    }

    /**
     * Разрешен ли выбранный статус
     *
     * @param Order $order
     * @param int   $status
     *
     * @return bool
     */
    private function statusAllowed(Order $order, int $status): bool
    {
        $allow = [];

        switch ($order->status) {
            case Order::ORDER_STATUS_NEW :
            case Order::ORDER_STATUS_PAYED :
            {
                $allow = [
                    Order::ORDER_STATUS_CANCELED_BY_BUYER,
                ];
                break;
            }
            case Order::ORDER_STATUS_SENT :
            {
                $allow = [
                    Order::ORDER_STATUS_RECEIVED,
                ];
                break;
            }
        }

        return in_array($status, $allow);
    }
}