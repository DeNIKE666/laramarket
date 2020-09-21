<?php

namespace App\Http\Controllers\Dashboard\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\OrderChangeStatusRequest;
use App\Http\Resources\Seller\OrderDetailsResource;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\Buyer\Cashback\CashbackService;
use App\Services\Seller\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    /** @var OrderService $orderService */
    private $orderService;

    /** @var CashbackService $cashbackService */
    private $cashbackService;

    /** @var OrderRepository $orderRepository */
    protected $orderRepository;

    public function __construct()
    {
        $this->orderService = app(OrderService::class);

        $this->cashbackService = app(CashbackService::class);

        $this->orderRepository = app(OrderRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('seller.order.list.in_progress');

//        $orders = $this->orderRepository->listOrdersShop();
//        return view(
//            'dashboard.seller.orders.index',
//            compact(
//                'orders'
//            )
//        );
    }

    /**
     * Заказы в работе
     *
     * @return View
     *
     * @author Anton Reviakin
     */
    public function listInProgress(): View
    {
        $statuses = [
            Order::ORDER_STATUS_NEW,
            Order::ORDER_STATUS_PAYED,
            Order::ORDER_STATUS_CONFIRMED,
            Order::ORDER_STATUS_SENT,
        ];

        $orders = $this
            ->orderRepository
            ->listOrdersSellerByStatus(
                $statuses,
                auth()->user()->id
            )
            ->paginate(10);

        return view(
            'dashboard.seller.orders.list_in_progress',
            compact('orders')
        );
    }

    /**
     * Заказы в архиве
     *
     * @return View
     */
    public function listInArchive(): View
    {
        $statuses = [
            Order::ORDER_STATUS_RECEIVED,
            Order::ORDER_STATUS_CANCELED_BY_BUYER,
            Order::ORDER_STATUS_CANCELED_BY_SELLER,
            Order::ORDER_STATUS_REJECT,
        ];

        $orders = $this
            ->orderRepository
            ->listOrdersSellerByStatus(
                $statuses,
                auth()->user()->id
            )
            ->paginate(10);

        return view(
            'dashboard.seller.orders.list_in_archive',
            compact('orders')
        );
    }

    /**
     * Изменить статус
     *
     * @param OrderChangeStatusRequest $request
     *
     * @return Response
     *
     * @author  Anton Reviakin
     */
    public function changeStatus(OrderChangeStatusRequest $request): Response
    {
        $order = $this
            ->orderService
            ->changeStatus($request);

        //Если Отправлено - добавить кэшбэк
        if ($order->status === Order::ORDER_STATUS_SENT) {
            $this
                ->cashbackService
                ->store($order);
        }

        return response($order, Response::HTTP_OK);
    }


    public function orderDetails(int $order)
    {
        $details = $this
            ->orderRepository
            ->getOrderDetailsForSeller(
                $order,
                auth()->user()->id
            )
        ->first();

        return OrderDetailsResource::make($details);
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
