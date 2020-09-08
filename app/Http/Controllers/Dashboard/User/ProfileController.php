<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\OrderChangeStatusRequest;
use App\Models\Order;
use App\Models\PaymentOption;
use App\Models\Property;
use App\Models\User;
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


class ProfileController extends Controller
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
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasSellerRequest()) {
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
        /** @var User $user */
        $user = Auth::user();
        $user->request_seller = 1;
        $user->save();

        $userProp = $user->isPropery($user->id);
        $userProp->edit($request->all());
        return redirect()->route('buyer.profile.edit')->with('status', 'Заявка отправлена');
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

        if ($order->status === Order::ORDER_STATUS_RECEIVED) {
            $CashbackService = new CashbackService();

            //Статус "Идут выплаты"
            $CashbackService->setInProgressStatus($order);

            //Период выплат
            $CashbackService->setPayoutsPeriod($order);

            //Заполнить расписание выплат кэшбэка
            (new CashbackScheduleService())->fill($order);
        }

        return response($order, Response::HTTP_OK);
    }

    public function historyOrder()
    {
        dd(__METHOD__);
//        $orders = $this->orderRepository->listOrdersUser();
//
//        return view(
//            'dashboard.user.history_orders'
//        );
    }

}
