<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function cart()  {
        $cartCollection = Cart::getContent();
        //Cart::clear();
        //dump($cartCollection);
        //return view('cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);
        return view('front.page.cart', compact('cartCollection'));
    }

    public function add(Request $request){
        //dd($request->all());
        Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                'slug' => $request->slug,
                'product_id' => $request->id
            )
        ));
        return redirect()->back()->with('status', 'Товар добавлен');
    }

    public function removeItem(Request $request)
    {
        Cart::remove($request->id);

        if (Cart::isEmpty()) {
            $resArray = [
                'msg'=> "empty",
            ];
            return response()->json($resArray, 200);
        }

        $resArray = [
            'msg'=> "ok",
            'total_price' => Cart::getTotal(),
            'total_quantity' => Cart::getTotalQuantity()
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
        if($request->action === 'minus')
            Cart::update($request->id, ['quantity' => -1]);
        if($request->action === 'plus')
            Cart::update($request->id, ['quantity' => 1]);
        //return view('front.page.cart', compact('cartCollection'));

        $msg = "ok";

        $resArray = [
            'msg'=> $msg,
            'product_id' => $request->id,
            'product_price' => Cart::get($request->id)->getPriceSum(),
            'total_price' => Cart::getTotal(),
            'total_quantity' => Cart::getTotalQuantity()
        ];
        return response()->json($resArray, 200);
    }

}
