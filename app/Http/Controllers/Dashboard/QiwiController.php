<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPay;
use App\Models\User;
use App\Services\Qiwi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QiwiController extends Controller
{

    public function orderPay(Request $request, Order $order)
    {
        $year = Carbon::now()->format('y') . $request->input('year');

        $orderPay = OrderPay::create([
            'user_id' => auth()->user()->id,
            'pay_system' => 'Кркдитная карта',
            'amount' => $order->cost,
            'status' => 0,
        ]);

        (new Qiwi())
            ->setCard($request->input('card'))
            ->setMonth($request->input('month'))
            ->setYear($year)
            ->setCvc($request->input('cvv'))
            ->setPhone('+7 978 801‑26‑49')
            ->setComment('Оплата аккаунта ' . auth()->user()->email)
            ->setAmount($order->cost)
            ->setCallback(route('qiwi.callback.order', [
                'order' => $order,
                'orderPay' => $orderPay
            ]))
            ->sendForm();

    }

    /**
     * @param Request $request
     */

    public function pay(Request $request)
    {
        $year = Carbon::now()->format('y') . $request->input('year');

        $order = OrderPay::create([
            'user_id' => auth()->user()->id,
            'pay_system' => 'Кредитная карта',
            'amount' => $request->input('amount'),
            'status' => 0,
        ]);

        (new Qiwi())
            ->setCard($request->input('card'))
            ->setMonth($request->input('month'))
            ->setYear($year)
            ->setCvc($request->input('cvv'))
            ->setPhone('+7 978 801‑26‑49')
            ->setComment('Оплата аккаунта ' . auth()->user()->email)
            ->setAmount($request->input('amount'))
            ->setCallback(route('qiwi.callback', $order))
            ->sendForm();


    }

    /**
     * @param Request $request
     * @param OrderPay $orderPay
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function callback(Request $request, OrderPay $orderPay)
    {
       $payStatus =  (new Qiwi())
            ->sendCallback($request->input('PaRes') , $request->input('MD'));

       if (!$payStatus)
           return redirect()
               ->route('user_pay')
               ->with('error', 'Не удалось оплатить');

       $orderPay->user()->increment('personal_account', $orderPay->amount);
       $orderPay->update(['status' => 1]);

        return redirect()
            ->route('user_pay')
            ->with('success' , 'Вы пополнили ваш счёт');
    }

    public function callbackOrder(Request $request, Order $order, OrderPay $orderPay)
    {
        
        $payStatus =  (new Qiwi())
            ->sendCallback($request->input('PaRes') , $request->input('MD'));

        if (!$payStatus)
            return redirect()
                ->route('user_pay')
                ->with('error', 'Не удалось оплатить');

        $order->update([
            'payment_status' => 1,
            'status' => 'PAID'
        ]);

        $orderPay->update([
            'status' => 1,
        ]);

        return redirect()
            ->route('user_pay')
            ->with('success' , 'Вы оплатили ваш заказ');

    }
}
