<?php
namespace App\Repositories;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Contracts\OrderContract;

class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function storeOrderDetails($params)
    {


        $order = Order::create([

            'user_id'           => auth()->user()->id,
            'status'            =>  'pending',
            'cost'              =>  Order::formatCost(Cart::getSubTotal()),
            //'item_count'        =>  Cart::getTotalQuantity(),
            'payment_status'    =>  0,
            'payment_method'    =>  $params['payment_method'],
            'name'              =>  $params['name'],
            'address'           =>  $params['address'],
            'delivery'          =>  $params['delivery'],
            'phones'            =>  $params['phones'],
            'notes'             =>  $params['notes']
        ]);

        if ($order) {

            $items = Cart::getContent();
            //dd($items);
            foreach ($items as $item)
            {

                try {
                    $product = Product::findOrFail($item->attributes['product_id']);
                } catch(ModelNotFoundException $e) {
                    dd($e);
                }


                $orderItem = new OrderItem([
                    'product_id'    =>  $item->attributes['product_id'],
                    'quantity'      =>  $item->quantity,
                    'price'         =>  Order::formatCost($item->getPriceSum())
                ]);

                $order->items()->save($orderItem);
            }
        }

        return $order;
    }

    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findOrderByNumber($orderNumber)
    {
        return Order::where('order_number', $orderNumber)->first();
    }

    public function listOrdersUser()
    {
        return Order::where('user_id', auth()->user()->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
    }

    public function listOrdersShop()
    {
        return Order::where('status', Order::STATUS_ORDER_START)
            ->whereHas('items', function($query) {
                $query->whereHas('product', function($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getOrderItemsOnlyThisShop(int $order_id)
    {
        return OrderItem::where('order_id', $order_id)
                ->whereHas('product', function($query) {
                    $query->where('user_id', auth()->user()->id);
                })->get();
    }
}
