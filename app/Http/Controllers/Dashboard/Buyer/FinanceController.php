<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Models\ExternalPayment;
use App\Models\PersonalHistoryAccount;
use App\Models\User;
use App\Models\Withdraw;
use App\Repositories\CashbackScheduleRepository;
use App\Repositories\ExternalPaymentsRepository;
use App\Repositories\PaySystemsRepository;
use App\Repositories\PersonalHistoryAccountRepository;
use App\Repositories\UserRepository;
use App\Services\Payments\CommissionsService;
use App\Services\QiwiP2P;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinanceController extends Controller
{
    /** @var CommissionsService $comissionsService */
    private $comissionsService;

    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var PaySystemsRepository $paySystemsRepository */
    private $paySystemsRepository;

    /** @var ExternalPaymentsRepository $externalPaymentsRepository */
    private $externalPaymentsRepository;

    /** @var PersonalHistoryAccountRepository $personalHistoryAccountRepository */
    private $personalHistoryAccountRepository;

    /** @var CashbackScheduleRepository $cashbackScheduleRepository */
    private $cashbackScheduleRepository;

    public function __construct()
    {
        $this->comissionsService = app(CommissionsService::class);

        $this->userRepository = app(UserRepository::class);
        $this->paySystemsRepository = app(PaySystemsRepository::class);
        $this->externalPaymentsRepository = app(ExternalPaymentsRepository::class);
        $this->personalHistoryAccountRepository = app(PersonalHistoryAccountRepository::class);
        $this->cashbackScheduleRepository = app(CashbackScheduleRepository::class);
    }

    /**
     * Форма пополнения и вывода
     *
     * @return View
     */
    public function depositOrWithdrawForm(): View
    {
        $depositings = $this
            ->paySystemsRepository
            ->list()
            ->depositing()
            ->get();

        $withdrawals = $this
            ->paySystemsRepository
            ->list()
            ->withdrawal()
            ->get();

        return view('dashboard.user.pay', compact('depositings', 'withdrawals'));
    }

    /**
     * Отправить на пополнение картой
     *
     * @param Request $request
     */
    public function depositViaCard(Request $request): void
    {
        $year = substr(Carbon::now()->format('Y'), 0, 2) . $request->input('year');

        $externalPayment = $this
            ->externalPaymentsRepository
            ->store([
                'user_id'         => auth()->user()->id,
                'pay_system'      => $request->input('pay_system'),
                'trans_direction' => ExternalPayment::DIR_IN,
                'trans_type'      => ExternalPayment::TYPE_DEPOSIT,
                'amount'          => $request->input('amount'),
                'status'          => ExternalPayment::STATUS_PENDING,
            ]);

        (new QiwiP2P())
            ->token()
            ->setCard($request->input('card'))
            ->setMonth($request->input('month'))
            ->setYear($year)
            ->setCvc($request->input('cvv'))
            ->setAmount($request->input('amount'))
            ->setCallback(route('buyer.finance.deposit_via_card_callback', [
                'user'            => auth()->user()->id,
                'externalPayment' => $externalPayment->id,
            ]))
            ->createOrder()
            ->sendPay();
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * @param Request         $request
     * @param User            $user
     * @param ExternalPayment $externalPayment
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function depositViaCardCallback(Request $request, User $user, ExternalPayment $externalPayment)
    {
        $payStatus = (new QiwiP2P())
            ->sendCallback($request->input('PaRes'), $request->input('MD'));

        if (!$payStatus) {
            return redirect()
                ->route('buyer.profile.edit')
                ->with('error', 'Не удалось оплатить');
        }

        //Статус оплаты
        $this
            ->externalPaymentsRepository
            ->changeStatus(
                $externalPayment->id,
                ExternalPayment::STATUS_COMPLETE
            );

        //Сумма пополнения с вычетом комиссии
        $amountWithComission = $this
            ->comissionsService
            ->paySystem($externalPayment->pay_system)
            ->depositWithoutCommission($externalPayment->amount);

        //Добавиьт на счет пользователю
        $this
            ->userRepository
            ->addToPartnerAccount(
                $user->id,
                $amountWithComission
            );

        //Записать в историю
        $this
            ->personalHistoryAccountRepository
            ->store([
                'user_id'         => $user->id,
                'trans_direction' => PersonalHistoryAccount::DIR_IN,
                'trans_type'      => PersonalHistoryAccount::TYPE_DEPOSIT,
                'pay_system_id'   => $externalPayment->pay_system,
                'amount'          => $amountWithComission,
            ]);

        return redirect()
            ->route('buyer.finance.deposit_withdraw')
            ->with('success', 'Счет пополнен');
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
