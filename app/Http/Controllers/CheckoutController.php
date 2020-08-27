<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\Buyer\Order\AddOrderService;
use App\Services\Order\OrderHistoryStatusService;
use Cart;
use Gate;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        return view('front.page.checkout');
    }

    public function placeOrder(Request $request)
    {
        //ВЫНЕСТИ В FormRequest
        $this->validate($request, [
            'name'           => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'phones'         => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'delivery'       => 'required|string|max:255',
        ]);

        $payMethod = $request->input('payment_method');

        $AddOrderService = new AddOrderService();
        $OrderHistoryStatusService = new OrderHistoryStatusService();

        //Добавить заказ
        $order = $AddOrderService->storeOrder($request);

        //Добавить товары в заказе
        $AddOrderService->storeOrderItems($order);

        //Добавить статус в историю - ПЕРЕПИСАТЬ НА OBSERVERS
        $OrderHistoryStatusService->storeOrderHistoryStatus($order, Order::STATUS_ORDER_NEW);

//        if ($order) {
        Cart::clear();
        return redirect()->route('infoOrder', [$order, $payMethod])->with('status', 'Заказ добавлен');
//        } else {
//            return redirect()->back()->with('message', 'Ошибка добавления заказа');
//        }
    }

    public function infoOrder(int $id, int $payMethod)
    {
        $order = Order::findOrFail($id);

        switch ($payMethod) {
            case 1:
                $payment = 'visa-payment';
                break;
        }

        $order = Order::findOrFail($id);

        abort_if(Gate::denies('update-post', $order), 403, 'Sorry, you are not an admin');

        return view('front.page.checkout_info', compact('order', 'payment'));
    }
}
