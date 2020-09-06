<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\OrderStoreRequest;
use App\Models\Order;
use App\Models\OrderPay;
use App\Services\Buyer\Order\AddOrderService;
use App\Services\Order\OrderHistoryStatusService;
use App\Services\Qiwi;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    private $addOrderService;
    private $orderHistoryStatusService;

    public function __construct()
    {
        $this->addOrderService = new AddOrderService();
        $this->orderHistoryStatusService = new OrderHistoryStatusService();
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * Показать форму оплаты
     *
     * @param int    $order
     * @param string $payMethod
     *
     * @return View
     */
    public function showPayForm(int $order, string $payMethod): View
    {
        $orderItem = Order::findOrFail($order);

        switch ($payMethod) {
            case Order::PAY_METHOD_VISA:
                $payment = 'visa-payment';
                break;
        }

        return view('front.page.checkout_info', compact('orderItem', 'payment'));
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * @param Request $request
     * @param Order   $order
     */
    public function payViaCard(Request $request, Order $order)
    {
        $year = substr(Carbon::now()->format('Y'), 0, 2) . $request->input('year');

        $orderPay = OrderPay::create([
            'user_id'    => auth()->user()->id,
            'pay_system' => 'Кредитная карта',
            'amount'     => $order->cost,
            'status'     => 0,
        ]);

        (new Qiwi())
            ->setCard($request->input('card'))
            ->setMonth($request->input('month'))
            ->setYear($year)
            ->setCvc($request->input('cvv'))
            ->setPhone('+7 978 801‑26‑49')
            ->setComment('Оплата аккаунта ' . auth()->user()->email)
            ->setAmount($order->cost)
            ->setCallback(route('buyer.checkout.pay-via-card.callback', [
                'order'    => $order,
                'orderPay' => $orderPay,
            ]))
            ->sendForm();
    }

    public function orderPayCallback(Request $request, Order $order, OrderPay $orderPay)
    {
        $payStatus = (new Qiwi())
            ->sendCallback($request->input('PaRes'), $request->input('MD'));

        if (!$payStatus)
            return redirect()
                ->route('buyer.finance.deposit-withdraw')
                ->with('error', 'Не удалось оплатить');

        $order->update([
            'status' => Order::ORDER_STATUS_PAYED,
        ]);

        $orderPay->update([
            'status' => 1,
        ]);

        return redirect()
            ->route('buyer.finance.deposit-withdraw')
            ->with('success', 'Вы оплатили ваш заказ');

    }
}
