<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use Cart;
use App\Models\Order;
use Gate;

class CheckoutController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        return view('front.page.checkout');
    }

    public function placeOrder(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phones' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'delivery' => 'required|string|max:255',
        ]);

        $order = $this->orderRepository->storeOrderDetails($request->all());

        if ($order) {
            Cart::clear();
            return redirect()->route('infoOrder', [$order])->with('status', 'заказ добавлен');
        } else {
            return redirect()->back()->with('message','Order not placed');
        }
    }

    public function infoOrder(int $id) {
        $order = Order::findOrFail($id);
        abort_if(Gate::denies('update-post', $order), 403, 'Sorry, you are not an admin');
        return view('front.page.checkout_info', compact('order'));
    }
}
