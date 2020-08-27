<?php


namespace App\Services\Buyer\Order;


use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Class AddOrderService
 *
 * @package App\Services\Buyer\Order
 *
 * @author  Anton Reviakin
 */
class AddOrderService
{
    /**
     * Добавить заказ
     *
     * @param Request $request
     *
     * @return Order
     */
    public function storeOrder(Request $request): Order
    {
        return Order::create([
            'user_id'        => auth()->user()->id,
            'status'         => Order::STATUS_ORDER_NEW,
            'cost'           => Order::formatCost(Cart::getSubTotal()),
            'payment_status' => 0,
            'payment_method' => $request->input('payment_method'),
            'name'           => $request->input('name'),
            'address'        => $request->input('address'),
            'delivery'       => $request->input('delivery'),
            'phones'         => $request->input('phones'),
        ]);
    }

    /**
     * Массовая вставка продуктов заказа
     *
     * @param Order $order
     *
     * @return bool
     * @author Anton Reviakin
     */
    public function storeOrderItems(Order $order): bool
    {
        $products = Cart::getContent();

        $orderItems = [];

        foreach ($products as $product) {
            //ПЕРЕПИСАТЬ!!!
            $percentFee = Product::where('id', $product->attributes['product_id'])->first('part_cashback');

            $orderItems[] = [
                'order_id'            => $order->id,
                'product_id'          => $product->attributes['product_id'],
                'quantity'            => $product->quantity,
                'price'               => Order::formatCost($product->getPriceSum()),
                'product_percent_fee' => $percentFee['part_cashback'],
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ];
        }

        return OrderItem::insert($orderItems);
    }
}