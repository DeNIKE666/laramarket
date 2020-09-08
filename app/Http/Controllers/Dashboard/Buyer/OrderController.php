<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\OrderStoreRequest;
use App\Models\Order;
use App\Models\OrdersDeliveryProfile;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Services\Buyer\Order\AddOrderService;
use App\Services\Buyer\Order\DeliveryProfilesService;
use App\Services\Order\OrderHistoryStatusService;
use App\Services\Shop\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    /** @var DeliveryProfilesService $deliveryProfilesService */
    private $deliveryProfilesService;

    /** @var OrderService $addOrderService */
    private $addOrderService;

    /** @var OrderHistoryStatusService $orderHistoryStatusService */
    private $orderHistoryStatusService;

    /** @var OrderRepository $orderRepository */
    private $orderRepository;

    public function __construct()
    {
        $this->deliveryProfilesService = app(DeliveryProfilesService::class);
        $this->addOrderService = app(AddOrderService::class);
        $this->orderHistoryStatusService = app(OrderHistoryStatusService::class);

        $this->orderRepository = app(OrderRepository::class);
    }

    /**
     * Форма оформления заказа
     *
     * @return View
     * @author Anton Reviakin
     */
    public function checkoutForm(): View
    {
        return view('front.page.checkout');
    }

    /**
     * Сохранить заказ и отправить на оплату
     *
     * @param OrderStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(OrderStoreRequest $request): RedirectResponse
    {
        $payMethod = $request->input('payment_method');

        /**
         * Профиль доставки
         *
         * @var OrdersDeliveryProfile $deliveryProfile
         */
        $deliveryProfile = $this->deliveryProfilesService->storeIfNotExists($request->input());

        /**
         * Добавить заказ
         *
         * @var Order $order
         */
        $order = $this->addOrderService->storeOrder($request->input(), $deliveryProfile->id);

        //Добавить статус в историю - ПЕРЕПИСАТЬ НА OBSERVERS
        $this->orderHistoryStatusService->storeOrderHistoryStatus($order, Order::ORDER_STATUS_NEW);

//        Cart::clear();

        return redirect()
            ->route('buyer.checkout.show-pay-form', compact('order', 'payMethod'))
            ->with('status', 'Заказ добавлен');
    }

    /**
     * Список заказов
     *
     * @return View
     */
    public function index(): View
    {
        $orders = $this
            ->orderRepository
            ->ordersByUser(auth()->user()->id);

        return view('dashboard.user.my_order', compact('orders'));
    }

    /**
     * Архив заказов
     *
     * @return View
     */
    public function archive(): View
    {
        $orders = $this
            ->orderRepository
            ->ordersByUser(
                auth()->user()->id,
                ['id', 'desc']
            );

        return view('dashboard.user.my_order', compact('orders'));
    }
}
