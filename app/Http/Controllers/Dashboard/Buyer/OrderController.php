<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\OrderChangeStatusRequest;
use App\Http\Requests\Buyer\OrderStoreRequest;
use App\Models\Order;
use App\Models\OrdersDeliveryProfile;
use App\Models\Payment;
use App\Models\PaymentOption;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentsRepository;
use App\Repositories\PaySystemsRepository;
use App\Services\Buyer\Order\AddOrderService;
use App\Services\Buyer\Order\DeliveryProfilesService;
use App\Services\Buyer\Order\OrderChangeStatusService;
use App\Services\Buyer\Order\OrdersHoldsScheduleService;
use App\Services\Buyer\Order\ProductReceivedService;
use App\Services\Order\OrderHistoryStatusService;
use App\Services\QiwiP2P;
use App\Services\Seller\OrderService;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    /** @var DeliveryProfilesService $deliveryProfilesService */
    private $deliveryProfilesService;

    /** @var OrderService $addOrderService */
    private $addOrderService;

    /** @var OrderChangeStatusService $orderChangeStatusService */
    private $orderChangeStatusService;

    /** @var OrderHistoryStatusService $orderHistoryStatusService */
    private $orderHistoryStatusService;

    /** @var OrdersHoldsScheduleService $ordersHoldsScheduleService */
    private $ordersHoldsScheduleService;

    /** @var ProductReceivedService $productReceivedService */
    private $productReceivedService;

    /** @var PaySystemsRepository $paySystemsRepository */
    private $paySystemsRepository;

    /** @var PaymentsRepository $paymentsRepository */
    private $paymentsRepository;

    /** @var OrderRepository $orderRepository */
    private $orderRepository;

    public function __construct()
    {
        $this->deliveryProfilesService = app(DeliveryProfilesService::class);
        $this->addOrderService = app(AddOrderService::class);
        $this->orderChangeStatusService = app(OrderChangeStatusService::class);
        $this->orderHistoryStatusService = app(OrderHistoryStatusService::class);

        $this->ordersHoldsScheduleService = app(OrdersHoldsScheduleService::class);

        $this->productReceivedService = app(ProductReceivedService::class);

        $this->paySystemsRepository = app(PaySystemsRepository::class);
        $this->paymentsRepository = app(PaymentsRepository::class);
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
        /** @var Payment $paySystems */
        $paySystems = $this
            ->paySystemsRepository
            ->list()
            ->purchasing()
            ->get();

        return view('front.page.checkout', compact('paySystems'));
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
        /**
         * Профиль доставки
         *
         * @var OrdersDeliveryProfile $deliveryProfile
         */
        $deliveryProfile = $this
            ->deliveryProfilesService
            ->storeIfNotExists($request->input());

        /**
         * Добавить в таблицу оплат
         *
         * @var Payment $payment
         */
        $payment = $this
            ->paymentsRepository
            ->store([
                'user_id'         => auth()->user()->id,
                'pay_system'      => $request->input('pay_system'),
                'trans_direction' => Payment::DIR_IN,
                'trans_type'      => Payment::TYPE_PURCHASE,
                'amount'          => Cart::getSubTotal(false), //ДОБАВИТЬ КОМИССИЮ!!!
                'status'          => Payment::STATUS_PENDING,
            ]);

        /**
         * Добавить заказ
         *
         * @var Order $order
         */
        $order = $this
            ->addOrderService
            ->storeOrder(
                $deliveryProfile->id,
                $payment->id
            );

        //Добавить статус в историю - ПЕРЕПИСАТЬ НА OBSERVERS
        $this
            ->orderHistoryStatusService
            ->storeOrderHistoryStatus(
                $order,
                Order::ORDER_STATUS_NEW
            );

        Cart::clear();

        return redirect()
            ->route(
                'buyer.order.show_pay_form',
                [
                    'order'     => $order->id,
                    'paySystem' => $request->input('pay_system'),
                ]
            )
            ->with('status', 'Заказ добавлен');
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * Показать форму оплаты
     *
     * @param Order         $order
     * @param PaymentOption $paySystem
     *
     * @return View
     */
    public function showPayForm(Order $order, PaymentOption $paySystem): ?View
    {
        return view('front.page.checkout_info', compact('order', 'paySystem'));
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * @param Request $request
     * @param Order   $order
     */
    public function payViaCard(Request $request, Order $order): void
    {
        $year = substr(Carbon::now()->format('Y'), 0, 2) . $request->input('year');

        (new QiwiP2P)
            ->token()
            ->setCard($request->input('card'))
            ->setMonth($request->input('month'))
            ->setYear($year)
            ->setCvc($request->input('cvv'))
            ->setAmount($order->cost)
            ->setCallback(route('buyer.order.pay_via_card_callback', [
                'order'   => $order->id,
                'payment' => $order->payment_id,
            ]))
            ->createOrder()
            ->sendPay();
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * @param Request $request
     * @param Order   $order
     * @param Payment $payment
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function payViaCardCallback(Request $request, Order $order, Payment $payment)
    {
        $payStatus = (new QiwiP2P())
            ->sendCallback($request->input('PaRes'), $request->input('MD'));

        if (!$payStatus) {
            return redirect()
                ->route('buyer.profile.edit')
                ->with('error', 'Не удалось оплатить');
        }

        //Статус заказа
        $this
            ->orderRepository
            ->changeStatus(
                $order->id,
                Order::ORDER_STATUS_PAYED
            );

        //Добавить статус в историю заказа
        $this
            ->orderHistoryStatusService
            ->storeOrderHistoryStatus(
                $order,
                Order::ORDER_STATUS_PAYED
            );

        //Статус оплаты
        $this
            ->paymentsRepository
            ->changeStatus(
                $payment->id,
                Payment::STATUS_COMPLETE
            );

        //Расписание холда
        $this
            ->ordersHoldsScheduleService
            ->store($order->id);

        return redirect()
            ->route('buyer.orders')
            ->with('success', 'Вы оплатили ваш заказ');
    }

    /**
     * Изменить статус заказа
     *
     * @param OrderChangeStatusRequest $request
     *
     * @return Response
     *
     * @author Anton Reviakin
     */
    public function changeStatus(OrderChangeStatusRequest $request): Response
    {
        $order = $this
            ->orderChangeStatusService
            ->changeStatus(
                $request->input('order_id'),
                auth()->user()->id,
                $request->input('status')
            );

        //Заказ получен
        if ($order->status === Order::ORDER_STATUS_RECEIVED) {
            $this
                ->productReceivedService
                ->productHasBeenReceived(
                    $order,
                    $request->input('period')
                );
        }

        return response($order, Response::HTTP_OK);
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
            ->ordersByUser(auth()->user()->id)
            ->paginate(10);

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
            ->ordersByUser(auth()->user()->id)
            ->orderByDesc('id')
            ->paginate(10);

        return view('dashboard.user.my_order', compact('orders'));
    }
}
