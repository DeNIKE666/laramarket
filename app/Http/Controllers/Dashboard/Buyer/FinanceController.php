<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Models\PaymentOption;
use App\Models\User;
use App\Models\Withdraw;
use App\Repositories\CashbackScheduleRepository;
use App\Repositories\PersonalHistoryAccountRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinanceController extends Controller
{
    /** @var PersonalHistoryAccountRepository $personalHistoryAccountRepository */
    private $personalHistoryAccountRepository;

    /** @var CashbackScheduleRepository $cashbackScheduleRepository */
    private $cashbackScheduleRepository;

    public function __construct()
    {
        $this->personalHistoryAccountRepository = app(PersonalHistoryAccountRepository::class);
        $this->cashbackScheduleRepository = app(CashbackScheduleRepository::class);
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function userPay()
    {
        $refills = PaymentOption::getPaymentsRefill();
        $withdrawals = PaymentOption::getPaymentWithdrawal();
        //dd($refill);
        return view(
            'dashboard.user.pay',
            compact(
                'refills',
                'withdrawals'
            )
        );
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function withdraw(Request $request)
    {
        $request->merge([
            'user_id'            => auth()->user()->id,
            'payment_options_id' => $request->input('method'),
        ]);

        Withdraw::create($request->all());

        return redirect()->route('buyer.finance.history.personal-account');
    }

    /**
     * История Персонального счета
     *
     * @return View
     */
    public function historyOfPersonalAccount(): View
    {
        $history = $this->personalHistoryAccountRepository->historyByUser(auth()->user()->id);

        return view('dashboard.user.history_withdraw', compact('history'));
    }

    /**
     * История начислений Кэшбэка
     *
     * @return View
     */
    public function historyOfCompletedCashback(): View
    {
        $history = $this->cashbackScheduleRepository->historyCompletedByUser(auth()->user()->id);

        return view('dashboard.user.cashback', compact('history'));
    }
}
