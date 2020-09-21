<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Buyer\FinanceResource;
use App\Models\Payment;
use App\Models\PersonalHistoryAccount;
use App\Models\User;
use App\Models\Withdraw;
use App\Repositories\CashbackScheduleRepository;
use App\Repositories\PaymentsRepository;
use App\Repositories\PaySystemsRepository;
use App\Repositories\PersonalHistoryAccountRepository;
use App\Repositories\UserRepository;
use App\Services\Payments\CommissionsService;
use App\Services\QiwiP2P;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinanceController extends Controller
{
    /** @var CommissionsService $commissionsService */
    private $commissionsService;


    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var PaySystemsRepository $paySystemsRepository */
    private $paySystemsRepository;

    /** @var PaymentsRepository $paymentsRepository */
    private $paymentsRepository;

    /** @var PersonalHistoryAccountRepository $personalHistoryAccountRepository */
    private $personalHistoryAccountRepository;

    /** @var CashbackScheduleRepository $cashbackScheduleRepository */
    private $cashbackScheduleRepository;

    public function __construct()
    {
        $this->commissionsService = app(CommissionsService::class);

        $this->userRepository = app(UserRepository::class);
        $this->paySystemsRepository = app(PaySystemsRepository::class);
        $this->paymentsRepository = app(PaymentsRepository::class);
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

        $paySystems = $this
            ->paySystemsRepository
            ->list()
            ->get();

        return view(
            'dashboard.buyer.finance.deposit_withdraw',
            compact(
                'depositings',
                'withdrawals',
                'paySystems'
            )
        );
    }

    /**
     * Отправить на пополнение картой
     *
     * @param Request $request
     */
    public function depositViaCard(Request $request): void
    {
        $year = substr(Carbon::now()->format('Y'), 0, 2) . $request->input('year');

        $payment = $this
            ->paymentsRepository
            ->store([
                'user_id'         => auth()->user()->id,
                'pay_system'      => $request->input('pay_system'),
                'trans_direction' => Payment::DIR_IN,
                'trans_type'      => Payment::TYPE_DEPOSIT,
                'amount'          => $request->input('amount'),
                'status'          => Payment::STATUS_PENDING,
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
                'payment' => $payment->id,
            ]))
            ->createOrder()
            ->sendPay();
    }

    /**
     * ПЕРЕПИСАТЬ!!!
     *
     * @param Request $request
     * @param User    $user
     * @param Payment $payment
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function depositViaCardCallback(Request $request, User $user, Payment $payment)
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
            ->paymentsRepository
            ->changeStatus(
                $payment->id,
                Payment::STATUS_COMPLETE
            );

        //Сумма пополнения с вычетом комиссии
        $amountWithComission = $this
            ->commissionsService
            ->paySystem($payment->pay_system)
            ->depositWithoutCommission($payment->amount);

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
                'pay_system_id'   => $payment->pay_system,
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
     * @return array
     * @throws \Throwable
     */
    public function historyOfPersonalAccount(): array
    {
        /** @var LengthAwarePaginator $paginator */
        $paginator = $this
            ->personalHistoryAccountRepository
            ->historyByUser(
                auth()->user()->id,
                ['id', 'desc']
            )
            ->paginate(10);

        return [
            'collection' => FinanceResource::collection($paginator),
            'meta'       => [
                'currentPage' => $paginator->currentPage(),
                'perPage'     => $paginator->perPage(),
            ],
            'paginator'  => view('pagination.default', compact('paginator'))->render(),
        ];
    }

    /**
     * История начислений Кэшбэка
     *
     * @return View
     */
    public function historyOfCompletedCashback(): View
    {
        $history = $this
            ->cashbackScheduleRepository
            ->historyCompletedByUser(auth()->user()->id);

        return view('dashboard.user.cashback', compact('history'));
    }
}
