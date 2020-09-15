<?php


namespace App\Services\Buyer\Order;


use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\Order\OrderHistoryStatusService;
use Illuminate\Http\Request;
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
     * @param Request $request
     *
     * @return Order
     */
    public function changeStatus(Request $request): Order
    {
        /** @var Order $order */
        $order = $this
            ->orderRepository
            ->getById($request->input('order_id'))
            ->ofBuyer(auth()->user()->id)
            ->firstOrFail();

        if (!$this->statusAllowed($order, $request->input('status'))) {
            abort(Response::HTTP_FORBIDDEN, 'Невозможно выбрать этот статус');
        }

        //Изменить статус заказа
        $order = $this
            ->orderRepository
            ->changeStatus(
                $order->id,
                $request->input('status')
            );

        //Добавить статус в историю заказа
        (new OrderHistoryStatusService)
            ->storeOrderHistoryStatus(
                $order,
                $request->input('status')
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