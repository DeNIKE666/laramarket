<?php

namespace App\Http\Controllers;

use Cart;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $cartCollection = Cart::getContent();
        //Cart::clear();
        //dump($cartCollection);
        //return view('cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);
        return view('front.page.cart', compact('cartCollection'));
    }

    public function add(Request $request)
    {
        if (!$this->allowedSeller($request->input('user_id'))) {
            return redirect()
                ->back()
                ->withErrors(
                    'На данный момент покупка товаров от разных продавцов в одном заказе невозможна'
                );
        }

        Cart::add([
            'id'         => $request->input('id'),
            'name'       => $request->input('name'),
            'price'      => $request->input('price'),
            'quantity'   => $request->input('quantity'),
            'attributes' => [
                'image'      => $request->input('img'),
                'slug'       => $request->input('slug'),
                'product_id' => $request->input('id'),
                'seller_id'  => $request->input('user_id'),
            ],
        ]);

        return redirect()
            ->back()
            ->with(
                'status',
                'Товар добавлен'
            );
    }

    public function removeItem(Request $request)
    {
        Cart::remove($request->id);

        if (Cart::isEmpty()) {
            $resArray = [
                'msg' => "empty",
            ];
            return response()->json($resArray, 200);
        }

        $resArray = [
            'msg'            => "ok",
            'total_price'    => Cart::getTotal(),
            'total_quantity' => Cart::getTotalQuantity(),
        ];
        return response()->json($resArray, 200);
    }

    public function clearCart()
    {
        Cart::clear();

        return redirect('/');
    }

    public function update(Request $request)
    {
        if ($request->action === 'minus')
            Cart::update($request->id, ['quantity' => -1]);
        if ($request->action === 'plus')
            Cart::update($request->id, ['quantity' => 1]);
        //return view('front.page.cart', compact('cartCollection'));

        $msg = "ok";

        $resArray = [
            'msg'            => $msg,
            'product_id'     => $request->id,
            'product_price'  => Cart::get($request->id)->getPriceSum(),
            'total_price'    => Cart::getTotal(),
            'total_quantity' => Cart::getTotalQuantity(),
        ];
        return response()->json($resArray, 200);
    }

    /**
     * Запретить добавлять в заказ другого продавца
     *
     * @param int $sellerId
     *
     * @return bool
     */
    private function allowedSeller(int $sellerId): bool
    {
        /** @var CartCollection $cart */
        $cart = Cart::getContent();

        if ($cart->isEmpty()) {
            return true;
        }

        //Массив продавцов
        $allowSellers = $cart->pluck('attributes.seller_id')->all();

        return in_array($sellerId, $allowSellers);
    }
}
