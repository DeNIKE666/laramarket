<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPay;
use App\Services\Qiwi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QiwiController extends Controller
{

    /**
     * @param Request $request
     */

    public function pay(Request $request)
    {
//        $year = Carbon::now()->format('y') . $request->input('year');
        $year = substr(Carbon::now()->format('Y'), 0, 2) . $request->input('year');

        $order = OrderPay::create([
            'user_id'    => auth()->user()->id,
            'pay_system' => 'Кредитная карта',
            'amount'     => $request->input('amount'),
            'status'     => 0,
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
     * @param Request  $request
     * @param OrderPay $orderPay
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function callback(Request $request, OrderPay $orderPay)
    {
        $payStatus = (new Qiwi())
            ->sendCallback($request->input('PaRes'), $request->input('MD'));

        if (!$payStatus)
            return redirect()
                ->route('buyer.finance.deposit-withdraw')
                ->with('error', 'Не удалось оплатить');

        $orderPay->user()->increment('personal_account', $orderPay->amount);
        $orderPay->update(['status' => 1]);

        return redirect()
            ->route('buyer.finance.deposit-withdraw')
            ->with('success', 'Вы пополнили ваш счёт');
    }
}
