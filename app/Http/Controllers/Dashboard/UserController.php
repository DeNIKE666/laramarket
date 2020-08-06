<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\User;
use App\Contracts\OrderContract;


class UserController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
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

    public function historyOrder()
    {
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
        return view(
            'dashboard.user.pay'

        );
    }

}
