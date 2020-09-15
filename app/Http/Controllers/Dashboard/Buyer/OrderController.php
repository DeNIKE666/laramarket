<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\OrderChangeStatusRequest;
use App\Http\Requests\Buyer\OrderStoreRequest;
use App\Models\ExternalPayment;
use App\Models\Order;
use App\Models\OrdersDeliveryProfile;
use App\Models\PaymentOption;
use App\Repositories\ExternalPaymentsRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaySystemsRepository;
use App\Services\Buyer\Order\AddOrderService;
use App\Services\Buyer\Order\DeliveryProfilesService;
use App\Services\Buyer\Order\OrderChangeStatusService;
use App\Services\Cashback\CashbackScheduleService;
use App\Services\Cashback\CashbackService;
use App\Services\Order\OrderHistoryStatusService;
use App\Services\QiwiP2P;
use App\Services\Shop\OrderService;
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

    /** @var CashbackService $cashbackService */
    private $cashbackService;

    /** @var CashbackScheduleService $cashbackScheduleService */
    private $cashbackScheduleService;

    /** @var PaySystemsRepository $paySystemsRepository */
    private $paySystemsRepository;

    /** @var ExternalPaymentsRepository $externalPaymentsRepository */
    private $externalPaymentsRepository;

    /** @var OrderRepository $orderRepository */
    private $orderRepository;

    public function __construct()
    {
        $this->deliveryProfilesService = app(DeliveryProfilesService::class);
        $this->addOrderService = app(AddOrderService::class);
        $this->orderChangeStatusService = app(OrderChangeStatusService::class);
        $this->orderHistoryStatusService = app(OrderHistoryStatusService::class);
        $this->cashbackService = app(CashbackService::class);
        $this->cashbackScheduleService = app(CashbackScheduleService::class);

        $this->paySystemsRepository = app(PaySystemsRepository::class);
        $this->externalPaymentsRepository = app(ExternalPaymentsRepository::class);
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
        /** @var ExternalPayment $paySystems */
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
        $payMethod = $request->input('pay_system');

        /**
         * Профиль доставки
         *
         * @var OrdersDeliveryProfile $deliveryProfile
         */
        $deliveryProfile = $this
            ->deliveryProfilesService
            ->storeIfNotExists($request->input());

        /**
         * Добавить заказ
         *
         * @var Order $order
         */
        $order = $this
            ->addOrderService
            ->storeOrder(
                $request->input(),
                $deliveryProfile->id
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
                    'paySystem' => $order->pay_system,
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

        /**
         * Добавить статус в оплаты
         *
         * @var ExternalPayment $externalPayment
         */
        $externalPayment = $this
            ->externalPaymentsRepository
            ->store([
                'user_id'         => auth()->user()->id,
                'pay_system'      => $order->pay_system,
                'trans_direction' => ExternalPayment::DIR_IN,
                'trans_type'      => ExternalPayment::TYPE_PURCHASE,
                'amount'          => $order->cost,
                'status'          => ExternalPayment::STATUS_PENDING,
            ]);

        (new QiwiP2P)
            ->token()
            ->setCard($request->input('card'))
            ->setMonth($request->input('month'))
            ->setYear($year)
            ->setCvc($request->input('cvv'))
            ->setAmount($order->cost)
            ->setCallback(route('buyer.order.pay_via_card_callback', [
                'order'           => $order->id,
                'externalPayment' => $externalPayment->id,
            ]))
            ->createOrder()
            ->sendPay();
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * @param Request         $request
     * @param Order           $order
     * @param ExternalPayment $externalPayment
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function payViaCardCallback(Request $request, Order $order, ExternalPayment $externalPayment)
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
            ->externalPaymentsRepository
            ->changeStatus(
                $externalPayment->id,
                ExternalPayment::STATUS_COMPLETE
            );

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
            ->changeStatus($request);

        //Заказ получен
        if ($order->status === Order::ORDER_STATUS_RECEIVED) {
            //Статус "Идут выплаты"
            $this
                ->cashbackService
                ->setInProgressStatus($order);

            //Период выплат
            $this
                ->cashbackService
                ->setPayoutsPeriod(
                    $order,
                    $request->input('period')
                );

            //Заполнить расписание выплат кэшбэка
            $this
                ->cashbackScheduleService
                ->fill($order);
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
