<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\Admin\UserRepository;
use App\Repositories\Admin\OrderRepository;

class AdminController extends Controller
{
    protected $adminUserRepository;
    protected $adminOrderRepository;

    public function __construct(
        UserRepository $adminUserRepository,
        OrderRepository $adminOrderRepository
    )
    {
        $this->adminUserRepository = $adminUserRepository;
        $this->adminOrderRepository = $adminOrderRepository;
    }

    public function index()
    {
        $user = Auth::user();
        return view(
            'dashboard.index',
            compact(
                'user'
            )
        );
    }

    public function getUsers()
    {
        $users = $this->adminUserRepository->listUsers();
        return view(
            'dashboard.admin.user_list',
            compact(
                'users'
            )
        );
    }

    public function infoUser(int $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            dd($e);
        }
        return view(
            'dashboard.admin.user_info',
            compact(
                'user'
            )
        );
    }

    public function approved_seller(Request $request)
    {
        try {
            $user = User::findOrFail($request->input('user_id'));
        } catch(ModelNotFoundException $e) {
            dd($e);
        }
        $user->role = User::ROLE_SHOP;
        $user->save();
        redirect()->back()->with('status', 'Заявка одобрена');
    }

    public function orders() {
        $orders = $this->adminOrderRepository->getAllOrders();
        return view(
            'dashboard.admin.order_list',
            compact(
                'orders'
            )
        );
    }
}
