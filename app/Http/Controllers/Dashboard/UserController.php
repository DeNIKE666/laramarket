<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\OrderChangeStatusRequest;
use App\Models\Order;
use App\Models\PaymentOption;
use App\Models\Property;
use App\Models\Withdraw;
use App\Repositories\OrderRepository;
use App\Services\Buyer\Order\OrderChangeStatusService;
use App\Services\Cashback\CashbackScheduleService;
use App\Services\Cashback\CashbackService;
use App\Services\UserService;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;


class UserController extends Controller
{
    protected $orderRepository;

    /** @var UserService */
    private $userService;

    /** @var OrderChangeStatusService */
    private $orderChangeStatusService;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;

        $this->userService = (new UserService());

        $this->orderChangeStatusService = (new OrderChangeStatusService($orderRepository));
    }

    /**
     * Страница редактирования профиля
     *
     * @return View
     */
    public function editProfile(): View
    {
        $user = Auth::user();
        return view('dashboard.edit_profile', compact('user'));
    }

    /**
     * Обновить информацию о профиле
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $user->edit($request->all());
        return redirect()->back()->with('status', 'Профиль обновлён');
    }

    /**
     * Стать партнером
     *
     * @return RedirectResponse
     */
    public function becomePartner(): RedirectResponse
    {
        $this->userService->setAsPartner();

        return redirect()
            ->back()
            ->with('status', __('users/partner.you_are_partner'));
    }

    /**
     * Форма создания заявки на Продавца
     *
     * @return View
     * @author Anton Reviakin
     */
    public function applicationToSeller(): View
    {
        $user = Auth::user();
        if ($user->request_shop == 1) {
            return redirect()->back()->with('status', 'Заявка на продовца отправлена');
        }
        //dd($user->hasPropery($user->id));
        if (!$property = $user->hasPropery($user->id)) {
            $property = new Property();
        }
        //$property = new Property();
        return view('dashboard.user.application_to_sellers', compact('user', 'property'));
    }

    public function storeApplicationToSeller(Request $request)
    {
        $user = Auth::user();
        $user->request_shop = 1;
        $user->save();

        $userProp = $user->isPropery($user->id);
        $userProp->edit($request->all());
        return redirect()->route('edit-profile')->with('status', 'Заявка отправлена');
    }

    public function listOrder()
    {
        $orders = $this->orderRepository->listOrdersUser();
        if (Auth::user()->is_admin) {
            return view(
                'dashboard.admin.order_list',
                compact(
                    'orders'
                )
            );
        } else {
            return view(
                'dashboard.user.my_order',
                compact(
                    'orders'
                )
            );
        }
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
        $order = $this->orderChangeStatusService->changeStatus($request);

        if ($order->status === Order::STATUS_ORDER_RECEIVED) {
            $CashbackService = new CashbackService();

            //Статус "Идут выплаты"
            $CashbackService->setInProgressStatus($order);

            //Период выплат
            $CashbackService->setPayoutsPeriod($order);

            //Заполнить расписание выплат кешбэка
            (new CashbackScheduleService())->fill($order);
        }

        return response($order, Response::HTTP_OK);
    }

    public function historyOrder()
    {
        $orders = $this->orderRepository->listOrdersUser();

        return view(
            'dashboard.user.history_orders'
        );
    }

    public function userCashback()
    {
        return view(
            'dashboard.user.cashback'

        );
    }

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
     * @param Request $request
     */

    public function withdraw(Request $request)
    {
        $request->merge([
            'user_id'            => auth()->user()->id,
            'payment_options_id' => $request->input('method'),
        ]);

        Withdraw::create($request->all());

        return redirect()->route('history.withdraw');
    }

    public function histroryWithdraw()
    {
        $withdraws = Withdraw::query()
            ->with('paymentOption:id,title')
            ->whereUserId(auth()->user()->id)
            ->get();

        return view('dashboard.user.history_withdraw', compact('withdraws'));
    }


}
