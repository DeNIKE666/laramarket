<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function cart()  {
        $cartCollection = Cart::getContent();
        //dd($cartCollection);
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

    public function removeItem($id)
    {
        Cart::remove($id);

        if (Cart::isEmpty()) {
            return redirect('/');
        }
        return redirect()->back()->with('status', 'Товар удален');
    }

    public function clearCart()
    {
        Cart::clear();

        return redirect('/');
    }

}
