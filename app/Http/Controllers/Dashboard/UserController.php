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
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;


class UserController extends Controller
{
    protected $orderRepository;

    /** @var OrderChangeStatusService */
    private $orderChangeStatusService;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;

        $this->orderChangeStatusService = (new OrderChangeStatusService($orderRepository));
    }

    public function edit_profile()
    {
        $user = Auth::user();
        return view(
            'dashboard.edit_profile',
            compact(
                'user'
            )
        );
    }

    public function edit_profile_data(Request $request)
    {
        $user = Auth::user();
        $user->edit($request->all());
        return redirect()->back()->with('status', 'Профиль обновлён');
    }

    public function active_partner()
    {
        $user = Auth::user();
        if ($user->is_partner) {
            return redirect()->back()->with(['error' => true, 'message' => 'Вы уже партнер']);
        } else {
            $user->is_partner = 1;
            $user->partner_token = Str::random(100);
            $user->save();
            return redirect()->back()->with('status', 'Вы стали парнером');
        }
    }

    public function application_to_sellers()
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
        return view(
            'dashboard.user.application_to_sellers',
            compact(
                'user',
                'property'
            )
        );
    }

    public function request_application_to_sellers(Request $request)
    {
        $user = Auth::user();
        $user->request_shop = 1;
        $user->save();

        $userProp = $user->isPropery($user->id);
        $userProp->edit($request->all());
        return redirect()->route('adminIndex')->with('status', 'Заявка отправлена');
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
            //Сохранить период выплат
            (new CashbackService())->setPayoutsPeriod($order);

            //Заполнить задания для выплат кешбека
            (new CashbackScheduleService())->fill($request, $order);
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
