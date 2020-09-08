<?php

namespace App\Http\Controllers\Dashboard\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\OrderChangeStatusRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\Cashback\CashbackService;
use App\Services\Shop\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderShopController extends Controller
{
    /** @var OrderRepository $orderRepository */
    protected $orderRepository;

    /** @var OrderService $orderService */
    private $orderService;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;

        $this->orderService = (new OrderService($orderRepository));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('order.list.in-progress');

//        $orders = $this->orderRepository->listOrdersShop();
//        return view(
//            'dashboard.shop.orders.index',
//            compact(
//                'orders'
//            )
//        );
    }

    /**
     * Заказы в работе
     *
     * @return View
     * @author Anton Reviakin
     *
     */
    public function listInProgress(): View
    {
        $statuses = [
            Order::ORDER_STATUS_PAYED,
            Order::ORDER_STATUS_CONFIRMED,
            Order::ORDER_STATUS_SENT,
        ];

        $orders = $this->orderRepository->listOrdersShopByStatus($statuses);

        return view(
            'dashboard.shop.orders.list_in_progress',
            compact(
                'orders'
            )
        );
    }

    /**
     * Изменить статус
     *
     * @param OrderChangeStatusRequest $request
     *
     * @return Response
     */
    public function changeStatus(OrderChangeStatusRequest $request): Response
    {
        $order = $this->orderService->changeStatus($request);

        //Если Отправлено - добавить кэшбэк
        if ($order->status === Order::ORDER_STATUS_SENT) {
            (new CashbackService)->storeCashback($order);
        }

        return response($order, Response::HTTP_OK);
    }

    public function detail(Order $order)
    {
        $order_items = $this->orderRepository->getOrderItemsOnlyThisShop($order->id);
        return view(
            'dashboard.shop.orders.detail',
            compact(
                'order',
                'order_items'
            )
        );
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
