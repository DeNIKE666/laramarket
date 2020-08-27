<?php


namespace App\Services\Shop;


use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\Order\OrderHistoryStatusService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderService
{
    /** @var OrderRepository $orderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Изменить статус заказа и записать в историю статусов заказа
     *
     * @param Request $request
     *
     * @return Order
     */
    public function changeStatus(Request $request): Order
    {
        $order = $this->orderRepository->getOwnOrderShopById($request->input('order_id'));

        if (!$order) {
            abort(Response::HTTP_NOT_FOUND, 'Заказ не найден');
        }

        if (!$this->statusAllowed($order, $request)) {
            abort(Response::HTTP_FORBIDDEN, 'Невозможно выбрать этот статус');
        }

        //Добавить статус в историю заказа
        (new OrderHistoryStatusService)->storeOrderHistoryStatus(
            $order,
            $request->input('status'),
            $request->input('notes')
        );

        //Изменить статус заказа
        return $this->orderRepository->changeOrderStatus(
            $order,
            $request->input('status'),
            $request->input('notes')
        );
    }

    /**
     * Разрешен ли выбранный статус
     *
     * @param Order   $order
     * @param Request $request
     *
     * @return bool
     */
    private function statusAllowed(Order $order, Request $request): bool
    {
        $allow = [];

        switch ($order->status) {
            case Order::STATUS_ORDER_PAYED :
            {
                $allow = [
                    Order::STATUS_ORDER_CONFIRMED,
                    Order::STATUS_ORDER_CANCELED_BY_SHOP,
                ];
                break;
            }
            case Order::STATUS_ORDER_CONFIRMED :
            {
                $allow = [
                    Order::STATUS_ORDER_SENT,
                    Order::STATUS_ORDER_CANCELED_BY_SHOP,
                ];
                break;
            }
        }

        return in_array($request->input('status'), $allow);
    }
}