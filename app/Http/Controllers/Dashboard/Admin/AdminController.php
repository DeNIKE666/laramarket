<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    private $userRepository;
    private $orderRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->orderRepository = app(OrderRepository::class);
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $user = Auth::user();
        return view('dashboard.index', compact('user'));
    }

    /**
     * Список пользователей
     *
     * @return View
     */
    public function getUsers(): View
    {
        $users = $this->userRepository->listUsers();

        return view('dashboard.admin.user_list', compact('users'));
    }

    public function infoUser(int $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            dd($e);
        }
        return view(
            'dashboard.admin.user_info',
            compact(
                'user'
            )
        );
    }

    /**
     * Одобрить заявку на продавца
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @author Anton Reviakin
     */
    public function approveAsSeller(Request $request): RedirectResponse
    {
        $this->userRepository->setAsSeller($request->input('id'));

        return redirect()->back()->with('status', 'Заявка одобрена');
    }

    public function orders()
    {
        $orders = $this->orderRepository->getAllOrders();
        return view(
            'dashboard.admin.order_list',
            compact(
                'orders'
            )
        );
    }

    /**
     * Список сообщений в техподдержку
     *
     * @return View
     */
    public function taskAdminList()
    {
        $tasks = Task::orderBy("id", "desc")->paginate(20);
        return view('dashboard.task.index', compact('tasks'));
    }
}
